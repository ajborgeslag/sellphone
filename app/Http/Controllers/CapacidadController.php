<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Capacidad;
use App\Http\Requests\CapacidadFormRequest;
use Exception;

class CapacidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $capacidades = Capacidad::all();

        return view('capacidades.index',['capacidades'=>$capacidades]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('capacidades.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CapacidadFormRequest $request)
    {
        $validatedData = $request->validated();

        $capacidad = new Capacidad();
        $capacidad->desc = $request->input('desc');
        $capacidad->save();

        return redirect('/capacidades');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $capacidad = Capacidad::find($id);

        return view('capacidades.edit',['capacidad'=>$capacidad]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CapacidadFormRequest $request, $id)
    {
        $validatedData = $request->validated();

        $capacidad = Capacidad::find($id);

        $capacidad->desc = $request->input('desc');
        $capacidad->update();

        return redirect('/capacidades');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try{
            $capacidad = Capacidad::find($id);

            $capacidad->delete();

            return redirect('/capacidades');
        }
        catch (Exception $e)
        {
            return redirect()->back()->withErrors(['No se puede eliminar esta capacidad, ya ha sido asignado a un celular !']);
        }


    }
}
