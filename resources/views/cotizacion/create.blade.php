@extends('layout')
@section('content')
    <div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Adicionar cotizacion</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form method="POST" id="formenviar" action="{{url('/cotizacion/store')}}" class="form-horizontal form-label-left input_mask">
                            @csrf

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Valor <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text"  placeholder="0.00" min="0" step="0.01" name="valor"  value="{{old('valor')}}" id="valor" class="form-control col-md-7 col-xs-12 valor">
                                    @error('valor')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fecha <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="fecha" value="{{old('fecha')}}" id="fecha" class="form-control col-md-7 col-xs-12 date-picker">
                                    @error('fecha')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!--<div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Hora <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="hora" placeholder="hh:mm" value="{{old('hora')}}" id="hora" class="form-control col-md-7 col-xs-12">
                                    @error('hora')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>-->


                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                    <a href="{{url('/cotizacion')}}" class="btn btn-primary"><i class="fa  fa-times"></i> Cancelar</a>
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

        $('#fecha').datetimepicker({
            format: 'DD-MM-YYYY hh:mm a'

        });
    });
</script>
@endsection
