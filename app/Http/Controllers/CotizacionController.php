<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cotizacion;
use App\Http\Requests\CotizacionFormRequest;
use Illuminate\Support\Facades\DB;

class CotizacionController extends Controller
{
    public function index()
    {
        $cotizaciones = Cotizacion::all()->sortByDesc('fecha');
		/*var_dump($cotizaciones);die();*/
        return view('cotizacion.index',['cotizaciones'=>$cotizaciones]);
    }

    public function create()
    {
        return view('cotizacion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(CotizacionFormRequest $request)
    {
        $validatedData = $request->validated();

        $cotizacion = new Cotizacion();
        $cotizacion->valor = $request->input('valor');
        $fecha =$request->input('fecha');
        $cotizacion->fecha = date('Y-m-d H:i',strtotime($fecha));
		$cotizacion->solo_fecha = date('Y-m-d',strtotime($fecha));
        $cotizacion->save();

        return redirect('/cotizacion');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cotizacion = Cotizacion::find($id);
        $fecha = date('d-m-Y H:i',strtotime($cotizacion->fecha));
        return view('cotizacion.edit',['cotizacion'=>$cotizacion,'fecha'=>$fecha]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(CotizacionFormRequest $request, $id)
    {
        $validatedData = $request->validated();

        $cotizacion = Cotizacion::find($id);
        $cotizacion->valor = $request->input('valor');
        $fecha =$request->input('fecha');
        $cotizacion->fecha = date('Y-m-d H:i:s',strtotime($fecha));
        $cotizacion->solo_fecha = date('Y-m-d',strtotime($fecha));
		$cotizacion->update();

        return redirect('/cotizacion');
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

            $cotizacion = Cotizacion::find($id);

            $cotizacion->delete();

            return redirect('/cotizacion');

    }
}
