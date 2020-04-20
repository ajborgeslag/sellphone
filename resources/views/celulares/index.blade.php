@extends('layout')
@section('content')
    <div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Celulares</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="table_celulares" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="50px">
                                    <a class="btn btn-primary btn-xs" href="{{url('celulares/create')}}">Adicionar celular</a>
                                    @if(Session::get('user')->role =='Administrador')
                                    <a class="btn btn-primary btn-xs" href="{{url('celulares/TableCelularesExport/'.$rol = Session::get('user')->role)}}">Exportar celulares</a>
                                    @endif
                                </th>
                                <th>Imei</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Color</th>
                                <th>Capacidad</th>
                                <th>Proveedor</th>
                                <th>Fecha compra</th>
                                <th>Precio compra</th>
                                <th>Comprador</th>
                                <th>Fecha venta</th>
                                <th>Precio venta</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($celulares as $celular)
                            <tr>
                                <td>
                                    <a href="{{url('/celulares/edit/'.$celular->id)}}" class="btn btn-default btn-xs btn-detail">Editar</a>
                                    <form method="POST" onsubmit="return confirm('Está seguro que desea eliminar el celular !');" action="{{url('/celulares/destroy/'.$celular->id)}}">
                                        @csrf
                                        {{method_field('DELETE')}}
                                        <button id="delete"  type="submit"  class="btn btn-danger btn-xs btn-delete">Eliminar</button>
                                        <a class="btn btn-success btn-xs" href="{{url('/celulares/garantia/'.$celular->id)}}" target="_blank">Garantia</a>
                                     </form>
                                </td>
                                <td>{{$celular->imei}}</td>
                                <td>{{$celular->marca_desc}}</td>
                                <td>{{$celular->modelo_desc}}</td>
                                <td>{{$celular->color_desc}}</td>
                                <td>{{$celular->capacidad_desc}}</td>
                                <td>{{$celular->vendedor}}</td>
                                <td><?php echo date('d-m-Y',strtotime($celular->fecha_compra))?></td>
                                <td>{{$celular->precio_compra}}</td>
                                <td>{{$celular->comprador}}</td>
                                <td>{{$celular->fecha_venta}}</td>
                                <td>{{$celular->precio_venta}}</td>
                            </tr>
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

            $('#table_celulares').dataTable({
                "language" : {
                    "url":'lan/spanish.json'
                }
            });

            /*$('#delete').on('submit',function (e) {
                e.preventDefault();
                if(!confirm('Está seguro que desea eliminar el celular'))
                {
                    e.preventDefault();
                }
            });*/

        });
    </script>
@endsection

