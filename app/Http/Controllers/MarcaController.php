<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarcaFormRequest;
use Illuminate\Http\Request;
use App\Marca;
use Exception;


class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcas = Marca::all();

        return view('marcas.index',['marcas'=>$marcas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('marcas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MarcaFormRequest $request)
    {
        $validatedData = $request->validated();

        $marca = new Marca();
        $marca->desc = $request->input('desc');
        $marca->save();

        return redirect('/marcas');
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
        $marca = Marca::find($id);

        return view('marcas.edit',['marca'=>$marca]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MarcaFormRequest $request, $id)
    {
        $validatedData = $request->validated();

        $marca = Marca::find($id);

        $marca->desc = $request->input('desc');
        $marca->update();

        return redirect('/marcas');
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
            $marca = Marca::find($id);

            $marca->delete();

            return redirect('/marcas');
        }
        catch (Exception $e)
        {
            return redirect()->back()->withErrors(['No se puede eliminar esta marca, ya ha sido asignado a un celular !']);
        }


    }

    /*public function messages()
    {
        return [
            'desc.required' => 'El campo color es obligatorio',
        ];
    }*/
}
