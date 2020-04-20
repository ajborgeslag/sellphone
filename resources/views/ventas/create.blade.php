@extends('layout')
@section('content')
    <div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Adicionar venta</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form method="POST" id="formenviar" action="{{url('/ventas/store')}}" class="form-horizontal form-label-left input_mask">
                            @csrf
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fecha venta <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12 divdate">
                                    <input type="text" name="fecha_venta" value="{{old('fecha_venta')}}" id="fecha_venta" class="form-control col-md-7 col-xs-12 date">
                                    @error('fecha_venta')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Imei <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="imei" id="imei_id" class="form-control col-md-7 col-xs-12 js-example-basic-single">
                                        @if($celulares->count()>0)
                                            <option value="">Seleccione el imei</option>
                                            @foreach($celulares as $celular)
                                            @if(($celular->fecha_venta==null)||($celular->fecha_venta=='0000-00-00'))
                                                    @if($celular->imei == old('imei'))
                                                    <option value="{{$celular->imei}}" selected>{{$celular->imei}}</option>
                                                    @else
                                                    <option value="{{$celular->imei}}">{{$celular->imei}}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @else
                                            No existen celuares
                                        @endif
                                    </select>
                                    @error('imei')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> Dolar <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" placeholder="0.00" value="{{old('precio_dollar')}}" min="0" step="0.01" name="precio_dollar" id="precio_dollar" class="form-control col-md-7 col-xs-12 precio_dollar">
                                    @error('precio_dollar')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pesos <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" placeholder="0.00" min="0" step="0.01" value="{{old('precio')}}" name="precio" id="precio" class="form-control col-md-7 col-xs-12 precio">
                                    @error('precio')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Vendedor <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="vendedor" class="form-control col-md-7 col-xs-12 js-example-basic-single">
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
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Precio venta
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" placeholder="0.00" min="0" step="0.01" value="{{old('precio_venta')}}" name="precio_venta" id="precio_venta" class="form-control col-md-7 col-xs-12 precio_venta bold" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="nombre" id="nombre" value="{{old('nombre')}}" class="form-control col-md-7 col-xs-12 nombre">
                                    @error('nombre')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Telefono
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="telefono" id="telefono" value="{{old('telefono')}}" class="form-control col-md-7 col-xs-12 telefono">
                                    @error('telefono')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="email" id="email" value="{{old('email')}}" class="form-control col-md-7 col-xs-12 email">
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Metodo de Pago <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="metodo_pago" class="form-control col-md-7 col-xs-12 js-example-basic-single">

                                        <option value="">Seleccione Metodo de Pago</option>
                                        <option value="Efectivo"<?= "Efectivo" === old('metodo_pago')? 'selected' : '' ?>>Efectivo</option>
                                        <option value="Transferencia"<?= "Transferencia" === old('metodo_pago') ? 'selected' : '' ?>>Transferencia</option>
                                        <option value="Tarjeta"<?= "Tarjeta" === old('metodo_pago') ? 'selected' : '' ?>>Tarjeta</option>
                                    </select>
                                    @error('metodo_pago')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo Cliente <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="tipo_cliente" class="form-control col-md-7 col-xs-12 js-example-basic-single">

                                        <option value="">Seleccione Tipo Cliente</option>
                                        <option value="Mayorista"<?= "Mayorista" === old('tipo_cliente')? 'selected' : '' ?>>Mayorista</option>
                                        <option value="Minorista"<?= "Minorista" === old('tipo_cliente') ? 'selected' : '' ?>>Minorista</option>
                                    </select>
                                    @error('tipo_cliente')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Observacion
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea class="form-control" name="observacion" id="observacion" rows="2">{{old('observacion')}}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="hidden" name="cotizacion" id="cotizacion" class="form-control col-md-7 col-xs-12 cotizacion" value="{{$ultima_cotizacion->valor}}">
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                    <a href="{{url('/ventas')}}" class="btn btn-primary"><i class="fa  fa-times"></i> Cancelar</a>
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


        $('#fecha_venta').datetimepicker({
            format: 'DD-MM-YYYY hh:mm a'
        });

        $('#precio').change(function(){

            var precio = document.getElementById("precio").value;
            var precio_dollar = document.getElementById("precio_dollar").value;
            var cotizacion = document.getElementById("cotizacion").value;

            if(isNaN(precio)){
                precio="0.00";
            }

            if(isNaN(precio_dollar)){
                precio_dollar="0.00";
            }

            if(precio.length<=0 && precio_dollar.length<=0){

            document.getElementById("precio_venta").value = "0.00";

            }

            if(precio.length<=0){

                precio = "0.00";

            }
            if(precio_dollar.length<=0){

                precio_dollar = "0.00";
            }


            var precio_venta = parseFloat(precio_dollar)+(parseFloat(precio)/parseFloat(cotizacion));
            document.getElementById("precio_venta").value = String(precio_venta.toFixed(2));


        });

        $('#precio_dollar').change(function(){

            var precio = document.getElementById("precio").value;
            var precio_dollar = document.getElementById("precio_dollar").value;
            var cotizacion = document.getElementById("cotizacion").value;

            if(isNaN(precio)){
                precio="0.00";
            }

            if(isNaN(precio_dollar)){
                precio_dollar="0.00";
            }

            if(precio.length<=0 && precio_dollar.length<=0){

            document.getElementById("precio_venta").value = "0.00";



            }

            if(precio.length<=0){

            precio = "0.00";

            }
            if(precio_dollar.length<=0){

                precio_dollar = "0.00";
            }

            var precio_venta = (parseFloat(precio)/parseFloat(cotizacion))+parseFloat(precio_dollar);
            document.getElementById("precio_venta").value = String(precio_venta.toFixed(2));
        });

        $('#formenviar').submit(function(){

            if(document.getElementById("saldo_pesos").value.length<=0){
                document.getElementById("saldo_pesos").value = "0.0";
            }

            if(document.getElementById("saldo_dollar").value.length<=0){
                document.getElementById("saldo_dollar").value = "0.0";
            }
        });

    });
</script>
@endsection
