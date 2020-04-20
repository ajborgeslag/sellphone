<?php $__env->startSection('content'); ?>
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
                        <form method="POST" id="formenviar" action="<?php echo e(url('/ventas/store')); ?>" class="form-horizontal form-label-left input_mask">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fecha venta <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12 divdate">
                                    <input type="text" name="fecha_venta" value="<?php echo e(old('fecha_venta')); ?>" id="fecha_venta" class="form-control col-md-7 col-xs-12 date">
                                    <?php if ($errors->has('fecha_venta')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('fecha_venta'); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Imei <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="imei" id="imei_id" class="form-control col-md-7 col-xs-12 js-example-basic-single">
                                        <?php if($celulares->count()>0): ?>
                                            <option value="">Seleccione el imei</option>
                                            <?php $__currentLoopData = $celulares; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $celular): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(($celular->fecha_venta==null)||($celular->fecha_venta=='0000-00-00')): ?>
                                                    <?php if($celular->imei == old('imei')): ?>
                                                    <option value="<?php echo e($celular->imei); ?>" selected><?php echo e($celular->imei); ?></option>
                                                    <?php else: ?>
                                                    <option value="<?php echo e($celular->imei); ?>"><?php echo e($celular->imei); ?></option>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            No existen celuares
                                        <?php endif; ?>
                                    </select>
                                    <?php if ($errors->has('imei')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('imei'); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> Dolar <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" placeholder="0.00" value="<?php echo e(old('precio_dollar')); ?>" min="0" step="0.01" name="precio_dollar" id="precio_dollar" class="form-control col-md-7 col-xs-12 precio_dollar">
                                    <?php if ($errors->has('precio_dollar')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('precio_dollar'); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pesos <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" placeholder="0.00" min="0" step="0.01" value="<?php echo e(old('precio')); ?>" name="precio" id="precio" class="form-control col-md-7 col-xs-12 precio">
                                    <?php if ($errors->has('precio')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('precio'); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Vendedor <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="vendedor" class="form-control col-md-7 col-xs-12 js-example-basic-single">
                                        <?php if($vendedores->count()>0): ?>
                                            <option value="">Seleccione un vendedor</option>
                                            <?php $__currentLoopData = $vendedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendedor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($vendedor->desc == old('vendedor')): ?>
                                                    <option value="<?php echo e($vendedor->desc); ?>" selected><?php echo e($vendedor->desc); ?></option>
                                                <?php else: ?>
                                                    <option value="<?php echo e($vendedor->desc); ?>"><?php echo e($vendedor->desc); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            No existen vendedores
                                        <?php endif; ?>
                                    </select>
                                    <?php if ($errors->has('vendedor')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('vendedor'); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Precio venta
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" placeholder="0.00" min="0" step="0.01" value="<?php echo e(old('precio_venta')); ?>" name="precio_venta" id="precio_venta" class="form-control col-md-7 col-xs-12 precio_venta bold" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="nombre" id="nombre" value="<?php echo e(old('nombre')); ?>" class="form-control col-md-7 col-xs-12 nombre">
                                    <?php if ($errors->has('nombre')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('nombre'); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Telefono
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="telefono" id="telefono" value="<?php echo e(old('telefono')); ?>" class="form-control col-md-7 col-xs-12 telefono">
                                    <?php if ($errors->has('telefono')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('telefono'); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="email" id="email" value="<?php echo e(old('email')); ?>" class="form-control col-md-7 col-xs-12 email">
                                    <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
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
                                    <?php if ($errors->has('metodo_pago')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('metodo_pago'); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
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
                                    <?php if ($errors->has('tipo_cliente')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('tipo_cliente'); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Observacion
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea class="form-control" name="observacion" id="observacion" rows="2"><?php echo e(old('observacion')); ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="hidden" name="cotizacion" id="cotizacion" class="form-control col-md-7 col-xs-12 cotizacion" value="<?php echo e($ultima_cotizacion->valor); ?>">
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                    <a href="<?php echo e(url('/ventas')); ?>" class="btn btn-primary"><i class="fa  fa-times"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-success" name="submitbtn" value="aceptar"><i class="fa fa-save"></i> Aceptar</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\resources\views/ventas/create.blade.php ENDPATH**/ ?>