<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Caja;
use App\Venta;
use App\Cotizacion;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CajaFormRequest;

class CajaController extends Controller
{
    public function index(Request $request)
    {
        $ultima_cotizacion = Cotizacion::all()->last();
        $hoy =0;

        $ingreso_pesos=0;
        $egreso_pesos=0;

        $ingreso_dollar=0;
        $egreso_dollar=0;
		
		$fecha_search = ($request->input('search_fecha')=='')?'':date('Y-m-d',strtotime($request->input('search_fecha')));

        if(($fecha_search==null)||($fecha_search==date('Y-m-d'))){
            $fecha_search = date('Y-m-d');
            $hoy = 1;
        }


        $cajas = DB::table('cajas')
            ->join('users', 'users.id', '=', 'cajas.user_id')
            ->select('cajas.*','users.name as usuario')
            ->whereDate('cajas.fecha',$fecha_search)
            ->orderBy('created_at', 'desc')
            ->get();
			
		foreach($cajas as $caja){
              if($caja->concepto=='Ingreso'){
                $ingreso_pesos+=$caja->saldo_pesos;
                $ingreso_dollar+=$caja->saldo_dollar;
              }
              else{
                $egreso_pesos+=$caja->saldo_pesos;
                $egreso_dollar+=$caja->saldo_dollar;
              }
          }

          $total_dollar = $ingreso_dollar-$egreso_dollar;
          $total_pesos = $ingreso_pesos-$egreso_pesos;

        $cajaIngresosPesosGeneral = DB::table('cajas')
			->where('cajas.concepto','=','Ingreso')
            ->sum('cajas.saldo_pesos');
			
		$cajaDegresosPesosGeneral = DB::table('cajas')
			->where('cajas.concepto','=','Egreso')
            ->sum('cajas.saldo_pesos');

		$cajaIngresosDollarGeneral = DB::table('cajas')
			->where('cajas.concepto','=','Ingreso')
            ->sum('cajas.saldo_dollar');
			
		$cajaDegresosDollarGeneral = DB::table('cajas')
			->where('cajas.concepto','=','Egreso')
            ->sum('cajas.saldo_dollar');
			
		$total_dollar_general = $cajaIngresosDollarGeneral-$cajaDegresosDollarGeneral;
	    $total_pesos_general = $cajaIngresosPesosGeneral-$cajaDegresosPesosGeneral;
		
		return view('caja.index',['cajas'=>$cajas,'hoy'=>$hoy,'total_dollar'=>$total_dollar,'total_pesos'=>$total_pesos,'total_dollar_general'=>$total_dollar_general,'total_pesos_general'=>$total_pesos_general,'ultima_cotizacion'=>$ultima_cotizacion]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $ultima_cotizacion = Cotizacion::all()->last();
        $fecha_hoy = date('d-m-Y H:i:s');

        return view('caja.create',['ultima_cotizacion'=>$ultima_cotizacion,'fecha_hoy'=>$fecha_hoy]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CajaFormRequest $request)
    {
            $validatedData = $request->validated();
            $saldo_pesos = $request->input('saldo_pesos');
            $fecha = ($request->input('fecha')=='')?'':date('Y-m-d H:i:s',strtotime($request->input('fecha')));
            $saldo_dollar = $request->input('saldo_dollar');
            $observacion = $request->input('observacion');
            $concepto = $request->input('concepto');
            $ultima_cotizacion = Cotizacion::all()->last();

            $saldo_final = ($saldo_pesos/$ultima_cotizacion->valor)+$saldo_dollar;

            $caja = new Caja();
            $caja->saldo_dollar = $saldo_dollar;
            $caja->saldo_pesos = $saldo_pesos;
            $caja->fecha = $fecha;
            $caja->saldo_final = $saldo_final;
            $caja->observacion = $observacion;
            $caja->concepto = $concepto;
            $caja->user_id = $request->session()->get('user')->id;
            $caja->cotizacion_id = $ultima_cotizacion->id;
            $ultima_cotizacion->usado = 1;
            $ultima_cotizacion->update();
            $caja->save();

        return redirect('/caja');
    }

    public function edit($id)
    {

        $caja = Caja::find($id);
        $ultima_cotizacion = Cotizacion::find($caja->cotizacion_id);
        $caja->fecha = date('d-m-Y H:i:s',strtotime($caja->fecha));

        return view('caja.edit',['caja'=>$caja,'ultima_cotizacion'=>$ultima_cotizacion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(CajaFormRequest $request, $id)
    {
        $validatedData = $request->validated();

        $caja = Caja::find($id);
        $cotizacion = Cotizacion::find($caja->cotizacion_id);

        $saldo_pesos = $request->input('saldo_pesos');
        $fecha = ($request->input('fecha')=='')?'':date('Y-m-d H:i:s',strtotime($request->input('fecha')));
        $saldo_dollar = $request->input('saldo_dollar');
        $observacion = $request->input('observacion');
        $concepto = $request->input('concepto');

        $saldo_final = ($saldo_pesos/$cotizacion->valor)+$saldo_dollar;

        $caja->saldo_dollar = $saldo_dollar;
        $caja->saldo_pesos = $saldo_pesos;
        $caja->fecha = $fecha;
        $caja->saldo_final = $saldo_final;
        $caja->observacion = $observacion;
        $caja->concepto = $concepto;
        $caja->user_id = $request->session()->get('user')->id;
        $caja->update();

        return redirect('/caja');
    }

    public function destroy($id)
    {
        $ingreso_pesos=0;
        $egreso_pesos=0;

        $ingreso_dollar=0;
        $egreso_dollar=0;

        $fecha_hoy = date('Y-m-d');

        $caja = Caja::find($id);

        $cajas = DB::table('cajas')
                    ->where('cotizacion_id', '=', $caja->cotizacion_id)
                    ->get();

        if($cajas->count() == 1)
        {
            $cotizacion = Cotizacion::find($caja->cotizacion_id);
            $cotizacion->usado = 0;
            $cotizacion->update();
        }





        $cajas1 = DB::table('cajas')
            ->join('users', 'users.id', '=', 'cajas.user_id')
            ->select('cajas.*','users.name as usuario')
            ->whereDate('cajas.fecha',$fecha_hoy)
            ->get();


          foreach($cajas1 as $caj){
              if($caj->concepto=='Ingreso'){
                $ingreso_pesos+=$caj->saldo_pesos;
                $ingreso_dollar+=$caj->saldo_dollar;
              }
              else{
                $egreso_pesos+=$caj->saldo_pesos;
                $egreso_dollar+=$caj->saldo_dollar;
              }
          }

          $total_dollar = $ingreso_dollar-$egreso_dollar;
          $total_pesos = $ingreso_pesos-$egreso_pesos;



          $total_dollar+=$caja->saldo_dollar;
          $total_pesos+=$caja->saldo_pesos;

        $caja->delete();

        $cajas2 = DB::table('cajas')
        ->join('users', 'users.id', '=', 'cajas.user_id')
        ->select('cajas.*','users.name as usuario')
        ->whereDate('cajas.fecha',$fecha_hoy)
        ->get();

        $ultima_cotizacion = Cotizacion::all()->last();
        $hoy =1;

        /*return view('caja.index',['cajas'=>$cajas2,'hoy'=>$hoy,'total_dollar'=>$total_dollar,'total_pesos'=>$total_pesos,'ultima_cotizacion'=>$ultima_cotizacion]);*/
        return redirect('/caja');

    }

}
