<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModeloFormRequest;
use Illuminate\Http\Request;
use App\Modelo;
use App\Marca;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Exception;


class ModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$modelos = Modelo::all();
        $modelos = DB::table('modelos')
            ->leftjoin('marcas', 'marcas.id', '=', 'modelos.marca_id')
            ->select('modelos.*', 'marcas.desc as marca_desc')
            ->get();

        return view('modelos.index',['modelos'=>$modelos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marcas = Marca::all();
        return view('modelos.create',['marcas'=>$marcas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModeloFormRequest $request)
    {
        $validatedData = $request->validated();

        $modelo = new Modelo();
        $modelo->desc = $request->input('desc');
        $modelo->marca_id = $request->input('marca_id');
        $modelo->save();

        return redirect('/modelos');
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
        $modelo = Modelo::find($id);
        $marcas = Marca::all();

        return view('modelos.edit',['modelo'=>$modelo,'marcas'=>$marcas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModeloFormRequest $request, $id)
    {
        $validatedData = $request->validated();

        $modelo = Modelo::find($id);

        $modelo->desc = $request->input('desc');
        $modelo->marca_id = $request->input('marca_id');
        $modelo->update();

        return redirect('/modelos');
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
            $modelo = Modelo::find($id);

            $modelo->delete();

            return redirect('/modelos');
        }
        catch (Exception $e)
        {
            return redirect()->back()->withErrors(['No se puede eliminar este modelo, ya ha sido asignado a un celular !']);
        }


    }

    public function get_by_marca()
    {
        $modelos = DB::table('modelos')
            ->leftjoin('marcas', 'marcas.id', '=', 'modelos.marca_id')
            ->select('modelos.*', 'marcas.desc as marca_desc')
            ->where('modelos.marca_id',Input::get('marca_id'))
            ->get();

        return $modelos;
    }
}
