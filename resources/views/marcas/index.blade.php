@extends('layout')
@section('content')
    <div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Marcas</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            @if($errors->any())
                                <div class="alert alert-danger">{{ $errors->first() }}</div>
                            @endif
                        </div>
                        <table id="table_marcas" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="50px"><a class="btn btn-primary btn-xs" href="{{'marcas/create'}}">Adicionar marca</a></th>
                                <th>Marca</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($marcas as $marca)
                            <tr>
                                <td>
                                    <a href="{{url('/marcas/edit/'.$marca->id)}}" class="btn btn-default btn-xs btn-detail">Editar</a>
                                    <form method="POST" action="{{url('/marcas/destroy/'.$marca->id)}}">
                                        @csrf
                                        {{method_field('DELETE')}}
                                        <button type="submit" class="btn btn-danger btn-xs btn-delete">Eliminar</button>
                                    </form>
                                </td>
                                <td>{{$marca->desc}}</td>
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

            $('#table_marcas').dataTable({
                "language" : {
                    "url":'lan/spanish.json'
                }
            });



        });
    </script>
@endsection