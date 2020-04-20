<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Color;
use App\Http\Requests\ColorFormRequest;
use Exception;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colores = Color::all();

        return view('colores.index',['colores'=>$colores]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('colores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ColorFormRequest $request)
    {
        $validatedData = $request->validated();

        $color = new Color();
        $color->desc = $request->input('desc');
        $color->save();

        return redirect('/colores');
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
        $color = Color::find($id);

        return view('colores.edit',['color'=>$color]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ColorFormRequest $request, $id)
    {
        $validatedData = $request->validated();

        $color = Color::find($id);

        $color->desc = $request->input('desc');
        $color->update();

        return redirect('/colores');
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
            $color = Color::find($id);

            $color->delete();

            return redirect('/colores');
        }
        catch (Exception $e)
        {
            return redirect()->back()->withErrors(['No se puede eliminar este color, ya ha sido asignado a un celular !']);
        }

    }

    /*public function messages()
    {
        return [
            'desc.required' => 'El campo color es obligatorio',
        ];
    }*/
}
