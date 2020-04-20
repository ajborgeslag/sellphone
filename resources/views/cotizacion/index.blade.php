@extends('layout')
@section('content')
    <div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Cotizaciones</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="table_cotizaciones" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="50px">
                                    <a class="btn btn-primary btn-xs" href="{{url('cotizacion/create')}}">Adicionar cotizacion</a>
                                </th>
                                <th>Valor</th>
                                <th>Fecha</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cotizaciones as $cotizacion)
                                @if($cotizacion->usado === 0)
                                <tr>
                                        <td>
                                            <a href="{{url('/cotizacion/edit/'.$cotizacion->id)}}" class="btn btn-default btn-xs btn-detail">Editar</a>
                                            <form method="POST" onsubmit="return confirm('Está seguro que desea eliminar la cotizacion !');" action="{{url('/cotizacion/destroy/'.$cotizacion->id)}}">
                                                @csrf
                                                {{method_field('DELETE')}}
                                                <button id="delete"  type="submit"  class="btn btn-danger btn-xs btn-delete">Eliminar</button>
                                            </form>
                                        </td>
                                        <td>{{$cotizacion->valor}}</td>
                                        <td><?php echo date('d-m-Y h:i:s',strtotime($cotizacion->fecha))?></td>
                                </tr>
                                @else
                                <tr>
                                        <td>

                                        </td>
                                        <td>{{$cotizacion->valor}}</td>
                                        <td><?php echo date('d-m-Y h:i:s',strtotime($cotizacion->fecha))?></td>
                                </tr>
                                @endif
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>

        jQuery(document).ready(function($){

            $('#table_cotizaciones').dataTable({
                "language" : {
                    "url":'lan/spanish.json'
                },
				"order":[2,"desc"]
            });
        });
    </script>
@endsection

