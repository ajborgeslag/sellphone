<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Celular;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;


class ReportCelularesExport implements FromCollection ,  WithHeadings, ShouldAutoSize,  WithEvents
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    var $rol;

    public function __construct($role)
    {
        $this->rol = $role;
    }

    public function collection()
    {

        $celulares = DB::table('celulares')
            ->leftjoin('marcas', 'marcas.id', '=', 'celulares.marca_id')
            ->leftjoin('modelos', 'modelos.id', '=', 'celulares.modelo_id')
            ->leftjoin('capacidades', 'capacidades.id', '=', 'celulares.capacidad_id')
            ->select('marcas.desc as marca_desc', 'modelos.desc as modelo_desc', 'capacidades.desc as capacidad_desc','celulares.*')
            ->where('celulares.fecha_venta','0000-00-00')
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
                ->where('celulares.fecha_venta','0000-00-00')
                ->groupby('celulares.color_id')
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

                ->where('celulares.marca_id',$cel->marca_id)
                ->where('celulares.modelo_id',$cel->modelo_id)
                ->where('celulares.capacidad_id',$cel->capacidad_id)
                ->where('celulares.fecha_venta','0000-00-00')
                ->select('celulares.precio_compra')
                ->orderby('celulares.precio_compra','desc')
                ->groupby('celulares.precio_compra')
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

            $vendedores = DB::table('celulares')

                ->where('celulares.marca_id',$cel->marca_id)
                ->where('celulares.modelo_id',$cel->modelo_id)
                ->where('celulares.capacidad_id',$cel->capacidad_id)
                ->where('celulares.fecha_venta','0000-00-00')
                ->select('celulares.vendedor')
                ->distinct()
                ->groupby('celulares.vendedor')
                ->get();

            $string_vendedores = '';
            foreach ($vendedores as $vendedor)
            {
                if($string_vendedores=='')
                    $string_vendedores = $vendedor->vendedor;
                else
                    $string_vendedores = $string_vendedores.', '.$vendedor->vendedor;
            }
            $cel->vendedor = $string_vendedores;

            if($this->rol == "Operador")
            {
                unset($cel->marca_id);
                unset($cel->modelo_id);
                unset($cel->capacidad_id);
                unset($cel->color_id);
                unset($cel->fecha_compra);
                unset($cel->fecha_venta);
                unset($cel->comprador);
				unset($cel->vendedor);
                unset($cel->imei);
                unset($cel->precio_compra);
                unset($cel->precio_venta);
                unset($cel->id);
                unset($cel->created_at);
                unset($cel->updated_at);
                unset($cel->vendido);
                unset($cel->precios);
            }
            else
            {
                unset($cel->marca_id);
                unset($cel->modelo_id);
                unset($cel->capacidad_id);
                unset($cel->color_id);
                unset($cel->fecha_compra);
                unset($cel->fecha_venta);
                unset($cel->comprador);
                unset($cel->vendedor);
				unset($cel->imei);
                unset($cel->precio_compra);
                unset($cel->precio_venta);
                unset($cel->id);
                unset($cel->created_at);
                unset($cel->updated_at);
                unset($cel->vendido);
            }
        }

        return $celulares;
	}

    public function headings(): array
    {
        if($this->rol=="Operador"){
            return [
                'Marca',
                'Modelo',
                'Capacidad',
                'Colores',

            ];
        }
        return [
            'Marca',
            'Modelo',
            'Capacidad',
            'Colores',
            'Precios'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:E1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true);

            },
        ];
    }
}
