<?php

namespace App\Http\Controllers;

use App\Http\Requests\CelularFormRequest;
use Illuminate\Http\Request;
use App\Color;
use App\Celular;
use App\Marca;
use App\Capacidad;
use App\Modelo;
use App\Vendedor;
use Illuminate\Support\Facades\DB;
use App\Libraries\Excel\Excel;
use setasign\Fpdi\Fpdi;

class CelularController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $celulares = DB::table('celulares')
            ->leftjoin('marcas', 'marcas.id', '=', 'celulares.marca_id')
            ->leftjoin('modelos', 'modelos.id', '=', 'celulares.modelo_id')
            ->leftjoin('colores', 'colores.id', '=', 'celulares.color_id')
            ->leftjoin('capacidades', 'capacidades.id', '=', 'celulares.capacidad_id')
            ->select('celulares.*', 'marcas.desc as marca_desc', 'modelos.desc as modelo_desc', 'capacidades.desc as capacidad_desc', 'colores.desc as color_desc')
            ->get();

            foreach($celulares as $cel)
            {
                $venta = DB::table('ventas')
                ->where('celular_id', '=', $cel->id)
                ->get();


                if(count($venta)==0)
                {

                    if(($cel->fecha_venta =='0000-00-00')||($cel->fecha_venta==null))
                    {
                        $cel->fecha_venta = '';
                    }

                    else
                    {
                        $cel->fecha_venta = date('d-m-Y H:i:s',strtotime($cel->fecha_venta));
                    }

                }

                else
                {
                    $cel->fecha_venta = date('d-m-Y H:i:s',strtotime($venta[0]->fecha));
                }
            }

        $celulares_vendedores = DB::table('celulares')
        ->select('celulares.vendedor')
        ->distinct()
        ->get();

        $vendedores = Vendedor::all();

        if(count($vendedores)==0)
        {

            $arreglo = array();
            $cont =0;

            foreach($celulares_vendedores as $cv){
                $arreglo[$cont]=$cv->vendedor;
                $cont++;
            }

            $collection = collect($arreglo);
            $unique = $collection->unique();
            $temporal = $unique->values();

            for($i=0; $i<count($unique->values());$i++)
            {
                if($temporal[$i]!=null)
                {
                    $vendedor = new Vendedor();
                    $vendedor->desc = $temporal[$i];
                    $vendedor->save();
                }
            }
            
        }
        return view('celulares.index',['celulares'=>$celulares]);
    }

    public function report()
    {
        $celulares = DB::table('celulares')
            ->leftjoin('marcas', 'marcas.id', '=', 'celulares.marca_id')
            ->leftjoin('modelos', 'modelos.id', '=', 'celulares.modelo_id')
            ->leftjoin('capacidades', 'capacidades.id', '=', 'celulares.capacidad_id')
            ->select('marcas.desc as marca_desc', 'modelos.desc as modelo_desc', 'capacidades.desc as capacidad_desc','celulares.*')
            ->groupby('celulares.marca_id','celulares.modelo_id','celulares.capacidad_id')
            ->get();

        foreach ($celulares as $cel)
        {
            $colores = DB::table('celulares')
                ->leftjoin('colores', 'colores.id', '=', 'celulares.color_id')
                ->select('colores.desc as color_desc')
                ->where('celulares.marca_id',$cel->marca_id)
                ->where('celulares.modelo_id',$cel->modelo_id)
                ->where('celulares.capacidad_id',$cel->capacidad_id)
                ->get();

            $string_colores = '';
            foreach ($colores as $col)
            {
                if($string_colores=='')
                    $string_colores = $col->color_desc;
                else
                    $string_colores = $string_colores.', '.$col->color_desc;
            }

            $cel->colores = $string_colores;


            $precios = DB::table('celulares')
                ->select('celulares.precio_compra')
                ->where('celulares.marca_id',$cel->marca_id)
                ->where('celulares.modelo_id',$cel->modelo_id)
                ->where('celulares.capacidad_id',$cel->capacidad_id)
                ->orderby('celulares.precio_compra','desc')
                ->get();

            $string_precios = '';
            foreach ($precios as $pre)
            {
                if($string_precios=='')
                    $string_precios = $pre->precio_compra;
                else
                    $string_precios = $string_precios.', '.$pre->precio_compra;
            }

            $cel->precios = $string_precios;

        }

        /*var_dump($celulares);die();*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marcas = Marca::all();
        $colores = Color::all();
        $capacidades = Capacidad::all();
        $modelos = Modelo::all();

        $celulares_vendedores = DB::table('celulares')
        ->select('celulares.vendedor')
        ->distinct()
        ->get();

        /*$vendedores = Vendedor::all();

        if(count($vendedores)==0)
        {

            $arreglo = array();
            $cont =0;

            foreach($celulares_vendedores as $cv){
                $arreglo[$cont]=$cv->vendedor;
                $cont++;
            }

            $collection = collect($arreglo);
            $unique = $collection->unique();
            $temporal = $unique->values();

            for($i=0; $i<count($unique->values());$i++)
            {
                if($temporal[$i]!=null)
                {
                    $vendedor = new Vendedor();
                    $vendedor->desc = $temporal[$i];
                    $vendedor->save();
                }
            }
            $vendedores = Vendedor::all();

            return view('celulares.create',['marcas'=>$marcas,'capacidades'=>$capacidades,'colores'=>$colores, 'modelos' => $modelos,'vendedores'=>$vendedores]);
        }*/


        return view('celulares.create',['marcas'=>$marcas,'capacidades'=>$capacidades,'colores'=>$colores, 'modelos' => $modelos/*,'vendedores'=>$vendedores*/]);
    }

    public function garantia($id)
    {

        $celular = Celular::find($id);
        $marca = Marca::find($celular->marca_id)->desc;
        $modelo = Modelo::find($celular->modelo_id)->desc;
        $color = Color::find($celular->color_id)->desc;
        $capacidad =capacidad::find($celular->capacidad_id)->desc;
        $fecha_hoy = date('d-m-Y');

        $cadena_equipo = $marca.' '.$modelo.' '.$color.' '.$capacidad;

        $pdf = new Fpdi();
        $pdf->AddPage();

        $pdf->setSourceFile('CONDICIONES_DE_GARANTIA.pdf');

        $tplIdx = $pdf->importPage(1);

        $pdf->useTemplate($tplIdx,['adjustPageSize'=>false]);

        $pdf->SetFont('Courier');
        $pdf->setFontSize(12);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(40,230);
        $pdf->Write(0,$cadena_equipo);
        $pdf->SetXY(33,246);
        $pdf->Write(0,$celular->imei);
        $pdf->SetXY(37,262);
        $pdf->Write(0,$fecha_hoy);

        return response($pdf->Output());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CelularFormRequest $request)
    {
        $validatedData = $request->validated();
        $cadena_imei = $request->input('imei');
        $arreglo = explode(";", $cadena_imei);



        if($arreglo[0]==""){

            $celular = new Celular();
            $celular->marca_id = $request->input('marca_id');
            $celular->modelo_id = $request->input('modelo_id');
            $celular->color_id = $request->input('color_id');
            $celular->capacidad_id = $request->input('capacidad_id');
            $celular->comprador = $request->input('comprador');
            $fecha_compra = $request->input('fecha_compra');
            $celular->fecha_compra = date('Y-m-d',strtotime($fecha_compra));
            $celular->precio_compra = $request->input('precio_compra');
            $celular->vendedor = $request->input('proveedor');
            $celular->fecha_venta = ($request->input('fecha_venta')=='')?'':date('Y-m-d H:i:s',strtotime($request->input('fecha_venta')));
            $celular->precio_venta = $request->input('precio_venta');
            $celular->imei =$cadena_imei;
            $celular->comprador = " ";
            $celular->save();
        }
        else{
            foreach($arreglo as $arr){
                $celular = new Celular();
                $celular->marca_id = $request->input('marca_id');
                $celular->modelo_id = $request->input('modelo_id');
                $celular->color_id = $request->input('color_id');
                $celular->capacidad_id = $request->input('capacidad_id');
                $celular->comprador = $request->input('comprador');
                $fecha_compra = $request->input('fecha_compra');
                $celular->fecha_compra = date('Y-m-d ',strtotime($fecha_compra));
                $celular->precio_compra = $request->input('precio_compra');
                $celular->vendedor = $request->input('proveedor');
                $celular->fecha_venta = ($request->input('fecha_venta')=='')?'':date('Y-m-d H:i:s',strtotime($request->input('fecha_venta')));
                $celular->precio_venta = $request->input('precio_venta');
                $celular->imei =$arr;
                $celular->comprador = " ";
                $celular->save();
            }
        }

        return redirect('/celulares');
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
        $marcas = Marca::all();
        $colores = Color::all();
        $capacidades = Capacidad::all();
        $modelos = Modelo::all();
        $celular = Celular::find($id);
        $fecha=null;

        $venta = DB::table('ventas')
        ->where('celular_id', '=', $id)
        ->get();

        $celular->fecha_compra = date('d-m-Y',strtotime($celular->fecha_compra));

        if(count($venta)==0)
        {

            if(($celular->fecha_venta =='0000-00-00')||($celular->fecha_venta==null))
            {
                $fecha='';
            }

            else
            {
                $fecha = date('d-m-Y H:i:s',strtotime($celular->fecha_venta));
            }

        }

        else
        {
            $fecha = date('d-m-Y H:i:s',strtotime($venta[0]->fecha));
        }

        $celulares_vendedores = DB::table('celulares')
        ->select('celulares.vendedor')
        ->distinct()
        ->get();

        /*$vendedores = Vendedor::all();

        if(count($vendedores)==0)
        {
            $arreglo = array();
            $cont =0;

            foreach($celulares_vendedores as $cv){
                $arreglo[$cont]=$cv->vendedor;
                $cont++;
            }

            $collection = collect($arreglo);
            $unique = $collection->unique();
            $temporal = $unique->values();
            for($i=0; $i<count($unique->values());$i++)
            {
                if($temporal[$i]!=null)
                {
                    $vendedor = new Vendedor();
                    $vendedor->desc = $temporal[$i];
                    $vendedor->save();
                }
            }
            $vendedores1 = Vendedor::all();
            return view('celulares.create',['marcas'=>$marcas,'capacidades'=>$capacidades,'colores'=>$colores, 'modelos' => $modelos,'vendedores'=>$vendedores]);
        }*/

        return view('celulares.edit',['celular'=>$celular, 'marcas'=>$marcas,'capacidades'=>$capacidades,'colores'=>$colores, 'modelos' => $modelos,'fecha'=>$fecha/*,'vendedores'=>$vendedores*/]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CelularFormRequest $request, $id)
    {
        $validatedData = $request->validated();

        $celular = Celular::find($id);
        $celular->marca_id = $request->input('marca_id');
        $celular->modelo_id = $request->input('modelo_id');
        $celular->color_id = $request->input('color_id');
        $celular->capacidad_id = $request->input('capacidad_id');
        $celular->comprador = $request->input('comprador');
        $fecha_compra = $request->input('fecha_compra');
        $celular->fecha_compra = date('Y-m-d',strtotime($fecha_compra));
        $celular->precio_compra = $request->input('precio_compra');
        $celular->vendedor = $request->input('proveedor');
        $celular->fecha_venta = ($request->input('fecha_venta')=='')?'':date('Y-m-d H:i:s',strtotime($request->input('fecha_venta')));
        $celular->precio_venta = $request->input('precio_venta');
        $celular->imei = $request->input('imei');
        $celular->comprador = " ";
        $celular->update();

        return redirect('/celulares');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $celular = Celular::find($id);

        $celular->delete();
        return redirect('/celulares');
    }

}
