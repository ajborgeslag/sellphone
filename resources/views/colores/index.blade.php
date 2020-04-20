@extends('layout')
@section('content')
    <div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Colores</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            @if($errors->any())
                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                            @endif
                        </div>
                        <table id="table_colores" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="50px"><a class="btn btn-primary btn-xs" href="{{'colores/create'}}">Adicionar color</a></th>
                                <th>Color</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($colores as $color)
                            <tr>
                                <td>
                                    <a href="{{url('/colores/edit/'.$color->id)}}" class="btn btn-default btn-xs btn-detail">Editar</a>
                                    <form method="POST" action="{{url('/colores/destroy/'.$color->id)}}">
                                        @csrf
                                        {{method_field('DELETE')}}
                                        <button type="submit" class="btn btn-danger btn-xs btn-delete">Eliminar</button>
                                    </form>
                                </td>
                                <td>{{$color->desc}}</td>
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

            $('#table_colores').dataTable({
                "language" : {
                    "url":'lan/spanish.json'
                }
            });



        });
    </script>
@endsection