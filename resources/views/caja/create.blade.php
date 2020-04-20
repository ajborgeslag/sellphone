@extends('layout')
@section('content')
    <div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Adicionar caja</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form method="POST" id="formenviar" action="{{url('/caja/store')}}" class="form-horizontal form-label-left input_mask">
                            @csrf

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fecha
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="fecha" id="fecha" class="form-control col-md-7 col-xs-12" value="{{$fecha_hoy}}" readonly>
                                    @error('fecha')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Dolar
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" placeholder="0.00" min="0" step="0.01" name="saldo_dollar" id="saldo_dollar" value="{{old('saldo_dollar')}}" class="form-control col-md-7 col-xs-12 saldo_dollar">
                                    @error('saldo_dollar')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pesos
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" placeholder="0.00" min="0" step="0.01" name="saldo_pesos" value="{{old('saldo_pesos')}}" id="saldo_pesos" class="form-control col-md-7 col-xs-12 saldo_pesos">
                                    @error('saldo_pesos')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Saldo final <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" placeholder="0.00" min="0" step="0.01" name="saldo_final" value="{{old('saldo_final')}}" id="saldo_final" class="form-control col-md-7 col-xs-12 saldo_final bold" readonly>
                                    @error('saldo_final')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Observacion <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea class="form-control" name="observacion" id="observacion" rows="2">{{old('observacion')}}</textarea>
                                    @error('observacion')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Seccion de Concepto-->
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Concepto <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="concepto" class="form-control col-md-7 col-xs-12 js-example-basic-single">

                                        <option value="">Seleccione Concepto</option>
                                        <option value="Ingreso"<?= "Ingreso" === old('concepto')? 'selected' : '' ?>>Ingreso</option>
                                        <option value="Egreso"<?= "Egreso" === old('concepto') ? 'selected' : '' ?>>Egreso</option>

                                    </select>
                                    @error('concepto')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Fin de Concepto-->

                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="hidden" name="cotizacion" id="cotizacion" class="form-control col-md-7 col-xs-12 cotizacion" value="{{$ultima_cotizacion->valor}}">
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                    <a href="{{url('/caja')}}" class="btn btn-primary"><i class="fa  fa-times"></i> Cancelar</a>
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

        $('#saldo_pesos').change(function(){

            var saldo_pesos = document.getElementById("saldo_pesos").value;
            var saldo_dollar = document.getElementById("saldo_dollar").value;
            var cotizacion = document.getElementById("cotizacion").value;

            if(isNaN(saldo_pesos)){
                saldo_pesos="0.00";
            }

            if(isNaN(saldo_dollar)){
                saldo_dollar="0.00";
            }

            if((saldo_pesos.length<=0) && (saldo_dollar.length<=0)){
                    document.getElementById("saldo_final").value ="0.00";
            }

            if(saldo_pesos.length<=0){
                saldo_pesos="0.00";
            }

            if(saldo_dollar.length<=0){
                saldo_dollar = "0.00";
            }

            var saldo_final = (parseFloat(saldo_pesos)/parseFloat(cotizacion))+parseFloat(saldo_dollar);
            document.getElementById("saldo_final").value = String(saldo_final.toFixed(2));

        });

        $('#saldo_dollar').change(function(){

            var saldo_pesos = document.getElementById("saldo_pesos").value;
            var saldo_dollar = document.getElementById("saldo_dollar").value;
            var cotizacion = document.getElementById("cotizacion").value;

            if(isNaN(saldo_dollar)){

                saldo_dollar = "0.00";
            }

            if(isNaN(saldo_pesos)){

                saldo_pesos = "0.00";
            }

            if((saldo_pesos.length<=0) && (saldo_dollar.length<=0)){
                    document.getElementById("saldo_final").value ="0.00";
            }

            if(saldo_pesos.length<=0){
                saldo_pesos="0.00";
            }

            if(saldo_dollar.length<=0){
                saldo_dollar = "0.00";
            }

            var saldo_final = (parseFloat(saldo_pesos)/parseFloat(cotizacion))+parseFloat(saldo_dollar);
            document.getElementById("saldo_final").value = String(saldo_final.toFixed(2));

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
