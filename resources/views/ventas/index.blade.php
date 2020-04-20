@extends('layout')
@section('content')
@if($ultima_cotizacion == null)
<div class="alert alert-warning" role="alert">
   <h4>No existe cotizacion del dolar debe crearla antes de realizar una venta</h4>
  </div>
 @endif
 @error('observacion')
 <div class="alert alert-danger"><h4>{{ $message }}</h4></div>
 @enderror
    <div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Ventas</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="table_ventas" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                @if($ultima_cotizacion != null)
                                <th width="50px">
                                    <a class="btn btn-primary btn-xs" href="{{url('ventas/create')}}">Adicionar venta</a>
                                </th>
                                @endif
                                <th>Fecha venta</th>
                                <th>Imei</th>
                                <th>Precio en dolares</th>
                                <th>Precio en pesos</th>
                                <th>Precio venta</th>
                                <th>Vendedor</th>
                                <th>Nombre</th>
                                <th>Telefono</th>
                                <th>Email</th>
                                <th>Metodo de pago</th>
                                <th>Observacion</th>
                                <th>Usuario</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ventas as $venta)
                            <tr>
                                <td>
                                    <a href="{{url('/ventas/edit/'.$venta->id)}}" class="btn btn-default btn-xs btn-detail">Editar</a>
                                        <!-- Button trigger modal -->
                                        <div>
                                        <button type="button" class="btn btn-danger btn-xs btn-delete" data-toggle="modal" data-target="#exampleModal{{$venta->id}}">
                                        Eliminar
                                        </button>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal" id="exampleModal{{$venta->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModal{{$venta->id}}" aria-hidden="true">
                                        <div class="modal-dialog " role="document" >
                                            <div class="modal-content">
                                            <div class="modal-header ">
                                                <h5 class="modal-title col-md-10" id="exampleModalLabel">Eliminar Venta</h5>
                                                <button type="button" class="close" aria-label="Close" >
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="{{$venta->id}}" class="form-horizontal form-label-left input_mask" method="POST" action="{{url('/ventas/destroy/'.$venta->id)}}" >
                                                        @csrf
                                                         {{method_field('DELETE')}}
                                                        <label for="recipient-name" class="control-label col-md-2 col-sm-2 col-xs-10">Motivo:</label>
														<input id="{{$venta->id}}" type="hidden" value="{{$venta->id}}">
                                                        <textarea  class="form-control col-md-6 col-xs-12" name="observacion" id="observacion" rows="2"></textarea>
                                                            <div class="col-md-offset-7 col-md-9 col-sm-9 col-xs-12 ">
                                                                <a href="{{url('/ventas')}}" class="btn btn-primary"><i class="fa  fa-times"></i> Cancelar</a>
                                                                <button type="submit" class="btn btn-success" name="submitbtn" value="aceptar"><i class="fa fa-trash"></i> Aceptar</button>
                                                            </div>

                                                </form>
                                            </div>
                                        </div>
                                        </div>

                                </td>
                                <td><?php
                                    if($venta->fecha=='0000-00-00 00:00'){
                                        echo '';
                                    }else{
                                        echo date('d-m-Y h:i',strtotime($venta->fecha));
                                    }
                                    ?>
                                </td>
                                <td>{{$venta->imei}}</td>
                                <td>{{$venta->precio_dollar}}</td>
                                <td>{{$venta->precio}}</td>
                                <td>{{$venta->precio_venta}}</td>
                                <td>{{$venta->vendedor}}</td>
                                <td>{{$venta->nombre}}</td>
                                <td>{{$venta->telefono}}</td>
                                <td>{{$venta->email}}</td>
                                <td>{{$venta->metodo_pago}}</td>
                                <td>{{$venta->observacion}}</td>
                                <td>{{$venta->usuario}}</td>
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

            $('#table_ventas').dataTable({
                "language" : {
                    "url":'lan/spanish.json'
                }
            });

        });
    </script>
@endsection

