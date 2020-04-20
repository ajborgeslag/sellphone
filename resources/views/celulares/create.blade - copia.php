@extends('layout')
@section('content')
    <div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Adicionar celular</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form method="POST" id="formenviar" action="{{url('/celulares/store')}}" class="form-horizontal form-label-left input_mask">
                            @csrf
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Marca <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="marca_id" id="marca_id" class="form-control col-md-7 col-xs-12 js-example-basic-single">
                                        @if($marcas->count()>0)
                                            <option value="">Seleccione una marca</option>
                                            @foreach($marcas as $marca)
                                                @if($marca->id == old('marca_id'))
                                                    <option value="{{$marca->id}}" selected>{{$marca->desc}}</option>
                                                @else
                                                    <option value="{{$marca->id}}">{{$marca->desc}}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            No existen marcas
                                        @endif
                                    </select>
                                    @error('marca_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Modelo <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="modelo_id" id="modelo_id" class="form-control col-md-7 col-xs-12 js-example-basic-single">
                                        <option value="">Seleccione un modelo</option>
                                    </select>
                                    @error('modelo_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Color <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="color_id" class="form-control col-md-7 col-xs-12 js-example-basic-single">
                                        @if($colores->count()>0)
                                            <option value="">Seleccione un color</option>
                                            @foreach($colores as $color)
                                                @if($color->id == old('color_id'))
                                                    <option value="{{$color->id}}" selected>{{$color->desc}}</option>
                                                @else
                                                    <option value="{{$color->id}}">{{$color->desc}}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            No existen colores
                                        @endif
                                    </select>
                                    @error('color_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Capacidades <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="capacidad_id" class="form-control col-md-7 col-xs-12 js-example-basic-single">
                                        @if($capacidades->count()>0)
                                            <option value="">Seleccione una capacidad</option>
                                            @foreach($capacidades as $capacidad)
                                                @if($capacidad->id == old('capacidad_id'))
                                                    <option value="{{$capacidad->id}}" selected>{{$capacidad->desc}}</option>
                                                @else
                                                    <option value="{{$capacidad->id}}">{{$capacidad->desc}}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            No existen capacidades
                                        @endif
                                    </select>
                                    @error('capacidad_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Proveedor <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
								    <input type="text" name="proveedor" id="proveedor" value="{{old('proveedor')}}" class="form-control col-md-7 col-xs-12">
                                    @error('proveedor')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <!--<select name="vendedor" class="form-control col-md-7 col-xs-12 js-example-basic-single">
                                        @if($vendedores->count()>0)
                                            <option value="">Seleccione un vendedor</option>
                                            @foreach($vendedores as $vendedor)
                                                @if($vendedor->desc == old('vendedor'))
                                                    <option value="{{$vendedor->desc}}" selected>{{$vendedor->desc}}</option>
                                                @else
                                                    <option value="{{$vendedor->desc}}">{{$vendedor->desc}}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            No existen vendedores
                                        @endif
                                    </select>
                                    @error('vendedor')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror-->
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fecha compra <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="fecha_compra" value="{{old('fecha_compra')}}" id="fecha_compra" class="form-control col-md-7 col-xs-12 date">
                                    @error('fecha_compra')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Precio compra <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="precio_compra" value="{{old('precio_compra')}}" id="desc" class="form-control col-md-7 col-xs-12 precio_compra" >
                                    @error('precio_compra')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Imei <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea class="form-control" name="imei" id="textareaimei" rows="2">{{old('imei')}}</textarea>
                                    <small id="imeiHelp" class="form-text text-bold"><strong> Ejemplo: Imei;Imei1;Imei2</strong></small>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Comprador <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="comprador" id="comprador" class="form-control col-md-7 col-xs-12 comprador" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fecha venta <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="fecha_venta" id="fecha_venta" class="form-control col-md-7 col-xs-12 date-picker" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Precio venta <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="precio_venta" id="desc" class="form-control col-md-7 col-xs-12 precio_venta" readonly>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                    <a href="{{url('/celulares')}}" class="btn btn-primary"><i class="fa  fa-times"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-success" name="submitbtn" value="aceptar"><i class="fa fa-save"></i> Aceptar</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>

    jQuery(document).ready(function($){

        $('#fecha_compra').datetimepicker({
            format:'DD-MM-YYYY'
        });

        if($('#marca_id').val()!="")
        {
            $.get(
                    "{{url('modelos/get_by_marca')}}",
                    {marca_id: $('#marca_id').val()},
                    function (data) {
                        console.log(data);
                        var modelos = $('#modelo_id');
                        modelos.empty();

                        modelos.append("<option value=''>Seleccione un modelo</option>");

                        $.each(data,function (index,element) {
                            modelos.append("<option value='"+element.id+"'>"+element.desc+"</option>");
                        });
                    }

            );
        }



        $('#marca_id').change(function(){

            $.get(
                    "{{url('modelos/get_by_marca')}}",
                    {marca_id: $(this).val()},
                    function (data) {
                        console.log(data);
                        var modelos = $('#modelo_id');
                        modelos.empty();

                        modelos.append("<option value=''>Seleccione un modelo</option>");

                        $.each(data,function (index,element) {
                           modelos.append("<option value='"+element.id+"'>"+element.desc+"</option>");
                        });
                    }

            );

        });




    });
</script>
@endsection
