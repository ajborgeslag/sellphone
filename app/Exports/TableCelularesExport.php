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


class TableCelularesExport implements FromCollection ,  WithHeadings, ShouldAutoSize,  WithEvents
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $celulares = DB::table('celulares')
            ->leftjoin('marcas', 'marcas.id', '=', 'celulares.marca_id')
            ->leftjoin('modelos', 'modelos.id', '=', 'celulares.modelo_id')
            ->leftjoin('capacidades', 'capacidades.id', '=', 'celulares.capacidad_id')
            ->leftjoin('colores', 'colores.id', '=', 'celulares.color_id')
            ->leftjoin('ventas', 'ventas.celular_id', '=', 'celulares.id')
			->select('celulares.imei','marcas.desc as marca_desc', 'modelos.desc as modelo_desc','colores.desc as color_desc', 'capacidades.desc as capacidad_desc','celulares.vendedor','celulares.fecha_compra','celulares.precio_compra','celulares.comprador','celulares.fecha_venta','celulares.precio_venta','ventas.vendedor as cell_vendedor','ventas.telefono as cell_telefono','ventas.email as cell_email','ventas.metodo_pago as cell_metodo_pago','ventas.tipo_cliente as cell_tipo_cliente')
            ->get();

		/*foreach($celulares as $cel)
		{
			$cel->cell_vendedor = 'test';
		}	*/
			
        return $celulares;
    }

    public function headings(): array
    {
        return [
            'Imei',
            'Marca',
            'Modelo',
            'Color',
            'Capacidad',
            'Proveedor',
            'Fecha compra',
            'Precio compra',
            'Comprador',
			'Fecha venta',
            'Precio venta',
			'Vendedor',
			'Teléfono',
			'Email',
			'Método de pago',
			'Tipo de Cliente'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:P1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true);

            },
        ];
    }
}
