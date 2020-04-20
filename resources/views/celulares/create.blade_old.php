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
                                    <input type="text" name="comprador" value="{{old('comprador')}}" id="desc" class="form-control col-md-7 col-xs-12 .">
                                    @error('comprador')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
                                    <input type="text" name="precio_compra" value="{{old('precio_compra')}}" id="desc" class="form-control col-md-7 col-xs-12 precio_compra">
                                    @error('precio_compra')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Imei <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="imei" id="desc" class="form-control col-md-7 col-xs-12 imei">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Comprador <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="vendedor" id="desc" class="form-control col-md-7 col-xs-12 vendedor">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fecha venta <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="fecha_venta" id="fecha_venta" class="form-control col-md-7 col-xs-12 date-picker">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Precio venta <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="precio_venta" id="desc" class="form-control col-md-7 col-xs-12 precio_venta">
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                    <a href="{{url('/celulares')}}" class="btn btn-primary"><i class="fa  fa-times"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-success" name="submitbtn" value="aceptar"><i class="fa fa-save"></i> Aceptar</button>
                                    <button id="limpiar_id" class="btn btn-info" name="submitbtn" value="imei"><i class="fa fa-save"></i> Guardar y Agregar Imei</button>
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

        $('#fecha_venta').datetimepicker({
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

        $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });

        $('#limpiar_id').click(function(ev){

            ev.preventDefault();

            var marca_id = $("select[name=marca_id]").val();
            var modelo_id = $("select[name=modelo_id]").val();
            var color_id = $("select[name=color_id]").val();
            var capacidad_id = $("select[name=capacidad_id]").val();
            var comprador = $("input[name=comprador]").val();
            var fecha_compra =  $("input[name=fecha_compra]").val();
            var precio_compra = $("input[name=precio_compra]").val();
            var vendedor = $("input[name=vendedor]").val();
            var fecha_venta = $("input[name=fecha_venta]").val();
            var precio_venta = $("input[name=precio_venta]").val();
            var imei = $("input[name=imei]").val();

            $.ajax({
                type: 'POST',
                url:  "{{url('celulares/store')}}",
                data: {
                    marca_id:marca_id,
                    modelo_id:modelo_id,
                    color_id:color_id,
                    capacidad_id:capacidad_id,
                    comprador:comprador,
                    fecha_compra:fecha_compra,
                    precio_compra:precio_compra,
                    vendedor:vendedor,
                    fecha_venta:fecha_venta,
                    precio_venta:precio_venta,
                    imei:imei,
                },
                success: function(data){
                    console.log(data.success);
                    $('.imei').val('');
                }
            });



});


    });
</script>
@endsection
