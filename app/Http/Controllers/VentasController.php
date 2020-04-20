<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Celular;
use App\User;
use App\Cotizacion;
use App\Venta;
use App\Caja;
use App\Vendedor;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\VentaFormRequest;
use Illuminate\Support\Facades\Validator;


class VentasController extends Controller
{
    public function index()
    {
        $ultima_cotizacion = Cotizacion::all()->last();
        $ventas = DB::table('ventas')
            ->leftjoin('celulares', 'celulares.id', '=', 'ventas.celular_id')
            ->leftjoin('users', 'users.id', '=', 'ventas.user_id')
            ->select('ventas.*', 'celulares.imei as imei', 'celulares.precio_venta as precio_venta','users.name as usuario')
            ->get();
        return view('ventas.index',['ventas'=>$ventas,'ultima_cotizacion'=>$ultima_cotizacion]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $celulares = Celular::all();
		$vendedores = Vendedor::all();
        $ultima_cotizacion = Cotizacion::all()->last();
		/*$fecha_sin_hora = date('Y-m-d');
		$ultima_cotizacion = Cotizacion::whereDate('fecha','=',$fecha_sin_hora)->last();
		if($ultima_cotizacion)*/
        return view('ventas.create',['celulares'=>$celulares,'ultima_cotizacion'=>$ultima_cotizacion,'vendedores'=>$vendedores]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VentaFormRequest $request)
    {
            $validatedData = $request->validated();
            $fecha_venta =$request->input('fecha_venta');
            /*$hora = $request->input('hora_venta');*/
            $fecha_final = $fecha_venta/*.' '.$hora*/;
            $imei = $request->input('imei');
            $precio = $request->input('precio');
            $fecha = date('Y-m-d H:i',strtotime($fecha_final));
			$fecha_sin_hora = date('Y-m-d',strtotime($fecha_final));
            $precio_dollar = $request->input('precio_dollar');
            $vendedor = $request->input('vendedor');
            $ultima_cotizacion = Cotizacion::all()->last();
			//$ultima_cotizacion = Cotizacion::whereDate('fecha','=',$fecha_sin_hora)->last();
			
			/*if(!$ultima_cotizacion)
				return Redirect::back()->withInput(Input::all())->withErrors(['cotizacion'=>'No existe una cotización para la fecha de venta']);*/

            $precio_venta = ($precio/$ultima_cotizacion->valor)+$precio_dollar;

            $celular = DB::table('celulares')
            ->where('imei', '=', $imei)->first();

			$cell= Celular::find($celular->id);

            $venta = new Venta();
            $venta->celular_id = $celular->id;
            $venta->user_id = $request->session()->get('user')->id;
            $venta->cotizacion_id = $ultima_cotizacion->id;
            $venta->vendedor = $vendedor;
            $venta->precio_dollar = $precio_dollar;
            $venta->precio = $precio;
            $venta->fecha = $fecha;
            $venta->nombre = $request->input('nombre');
            $venta->email =  $request->input('email');
            $venta->telefono = $request->input('telefono');
            $venta->metodo_pago = $request->input('metodo_pago');
            $venta->observacion = $request->input('observacion');
            $venta->tipo_cliente = $request->input('tipo_cliente');
            $venta->save();

            if($venta->metodo_pago=="Efectivo")
			{
				$caja = new Caja();
				$caja->saldo_dollar = $precio_dollar;
				$caja->saldo_pesos = $precio;
				$caja->fecha = $fecha;
				$caja->saldo_final = $precio_venta;
				$caja->observacion = "Venta del celular con IMEI"." ".$cell->imei;
				$caja->concepto = 'Ingreso';
				$caja->user_id = $request->session()->get('user')->id;
				$caja->cotizacion_id = $ultima_cotizacion->id;
				$caja->venta_id = $venta->id;
				$caja->save();	
			}
			
			$cell->fecha_venta = date('Y-m-d',strtotime($request->input('fecha_venta')));
            $cell->precio_venta = $precio_venta;
            $cell->comprador = $request->input('nombre');
            $ultima_cotizacion->usado = 1;

            $cell->update();
            $ultima_cotizacion->update();

        return redirect('/ventas');
    }

    public function edit($id)
    {

        $venta = Venta::find($id);
        $celulares = Celular::all();
		$vendedores = Vendedor::all();
        $ultima_cotizacion = Cotizacion::find($venta->cotizacion_id);
        $fecha_venta = date('d-m-Y H:i',strtotime($venta->fecha));
        /*$hora_venta = date('H:i',strtotime($venta->fecha));*/

        return view('ventas.edit',['venta'=>$venta, 'celulares'=>$celulares,'ultima_cotizacion'=>$ultima_cotizacion,'fecha_venta'=>$fecha_venta/*,'hora_venta'=>$hora_venta*/,'vendedores'=>$vendedores]);
    }

    public function update(VentaFormRequest $request, $id)
    {
        $validatedData = $request->validated();
		$ultima_cotizacion = Cotizacion::all()->last();

        $venta = Venta::find($id);
        $celular_actual = Celular::find($venta->celular_id);
        $cotizacion = Cotizacion::find($venta->cotizacion_id);
        $caja_dat =  DB::table('cajas')
        ->where('venta_id', '=', $id)->first();

		if($caja_dat)
			$caja = Caja::find($caja_dat->id);



        $imei = $request->input('imei');
        $precio = $request->input('precio');
        $fecha_venta =$request->input('fecha_venta');
        /*$hora = $request->input('hora_venta');*/
        $fecha_final = $fecha_venta/*.' '.$hora*/;
        $fecha = date('Y-m-d H:i',strtotime($fecha_final));
        $precio_dollar = $request->input('precio_dollar');
        $vendedor = $request->input('vendedor');


        $precio_venta = ($precio/$cotizacion->valor)+$precio_dollar;
		
        if($imei != $celular_actual->imei)
        {
			$celular_selec = DB::table('celulares')->where('imei',$imei)->first();
            $celular = Celular::find($celular_selec->id);
			
            $venta->celular_id = $celular->id;
            $venta->user_id = $request->session()->get('user')->id;
            $venta->vendedor = $vendedor;
            $venta->precio_dollar = $precio_dollar;
            $venta->precio = $precio;
            $venta->fecha = $fecha;
            $venta->nombre = $request->input('nombre');
            $venta->email =  $request->input('email');
            $venta->telefono = $request->input('telefono');
            $venta->metodo_pago = $request->input('metodo_pago');
            $venta->observacion = $request->input('observacion');
            $venta->tipo_cliente = $request->input('tipo_cliente');

            $celular->fecha_venta = date('Y-m-d',strtotime($request->input('fecha_venta')));
            $celular->precio_venta = $precio_venta;
            $celular->comprador = $request->input('nombre');
			
			if($caja_dat && $venta->metodo_pago=="Efectivo")
			{
				$caja->saldo_dollar = $precio_dollar;
				$caja->saldo_pesos = $precio;
				$caja->fecha = $fecha;
				$caja->saldo_final = $precio_venta;
				$caja->user_id = $request->session()->get('user')->id;
				$caja->update();
			}
			else
			{
				if($venta->metodo_pago=="Efectivo")
				{
					$caja = new Caja();
					$caja->saldo_dollar = $precio_dollar;
					$caja->saldo_pesos = $precio;
					$caja->fecha = $fecha;
					$caja->saldo_final = $precio_venta;
					$caja->observacion = "Venta del celular con IMEI"." ".$celular->imei;
					$caja->concepto = 'Ingreso';
					$caja->user_id = $request->session()->get('user')->id;
					$caja->cotizacion_id = $ultima_cotizacion->id;
					$caja->venta_id = $venta->id;
					$caja->save();	
				}
			}			
            
			$celular_actual->update();
            $celular->update();
            $venta->update();
        }
		else
        {
            $venta->user_id = $request->session()->get('user')->id;
            $venta->vendedor = $vendedor;
            $venta->precio_dollar = $precio_dollar;
            $venta->precio = $precio;
            $venta->fecha = $fecha;
            $venta->nombre = $request->input('nombre');
            $venta->email =  $request->input('email');
            $venta->telefono = $request->input('telefono');
            $venta->metodo_pago = $request->input('metodo_pago');
            $venta->observacion = $request->input('observacion');
            $venta->tipo_cliente = $request->input('tipo_cliente');

            $celular_actual->comprador = $request->input('nombre');
            $celular_actual->fecha_venta = date('Y-m-d',strtotime($request->input('fecha_venta')));
            $celular_actual->precio_venta = $precio_venta;


            if($caja_dat && $venta->metodo_pago=="Efectivo")
			{
				$caja->saldo_dollar = $precio_dollar;
				$caja->saldo_pesos = $precio;
				$caja->fecha = $fecha;
				$caja->saldo_final = $precio_venta;
				$caja->user_id = $request->session()->get('user')->id;
				$caja->update();
			}
			else
			{
				if($venta->metodo_pago=="Efectivo")
				{
					$caja = new Caja();
					$caja->saldo_dollar = $precio_dollar;
					$caja->saldo_pesos = $precio;
					$caja->fecha = $fecha;
					$caja->saldo_final = $precio_venta;
					$caja->observacion = "Venta del celular con IMEI"." ".$imei;
					$caja->concepto = 'Ingreso';
					$caja->user_id = $request->session()->get('user')->id;
					$caja->cotizacion_id = $ultima_cotizacion->id;
					$caja->venta_id = $venta->id;
					$caja->save();	
				}
			}

            $celular_actual->update();
            $venta->update();
        }

        return redirect('/ventas');
    }

    public function destroy($id,Request $request)
    {
        $input = $request->all();
        $rules = [
            'observacion' => 'required',
        ];
        $messages = [
            'observacion.required' => 'Debe especificar el motivo por el cual va a eliminar una venta',
            ];

        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return redirect('/ventas')
            ->withErrors($validator)
            ->withInput();
        }

        $venta = Venta::find($id);
		
        $celular = Celular::find($venta->celular_id);
        $observacion = $request->input('observacion');

        $ventas = DB::table('ventas')
                    ->where('cotizacion_id', '=', $venta->cotizacion_id)
                    ->get();

		$cajaIngreso = DB::table('cajas')
                    ->where('venta_id', '=', $venta->id)
                    ->first();
		
		if($cajaIngreso)
		{
			$cajaIngreso = Caja::find($cajaIngreso->id);
			$cajaIngreso->delete();
		}
			
		if($ventas->count() == 1)
        {
            $cotizacion = Cotizacion::find($venta->cotizacion_id);
            $cotizacion->usado = 0;
            $cotizacion->update();
        }

        $celular->precio_venta = null;
        $celular->comprador = null;
        $celular->fecha_venta = null;
        $celular->update();
        $venta->delete();
		
		return redirect('/ventas');

    }


}
