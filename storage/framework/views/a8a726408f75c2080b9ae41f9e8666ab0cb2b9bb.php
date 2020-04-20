<?php $__env->startSection('content'); ?>
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
                        <form method="POST" action="<?php echo e(url('/celulares/store')); ?>" class="form-horizontal form-label-left input_mask">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Marca <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="marca_id" id="marca_id" class="form-control col-md-7 col-xs-12 js-example-basic-single">
                                        <?php if($marcas->count()>0): ?>
                                            <option value="">Seleccione una marca</option>
                                            <?php $__currentLoopData = $marcas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($marca->id == old('marca_id')): ?>
                                                    <option value="<?php echo e($marca->id); ?>" selected><?php echo e($marca->desc); ?></option>
                                                <?php else: ?>
                                                    <option value="<?php echo e($marca->id); ?>"><?php echo e($marca->desc); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            No existen marcas
                                        <?php endif; ?>
                                    </select>
                                    <?php if ($errors->has('marca_id')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('marca_id'); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Modelo <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="modelo_id" id="modelo_id" class="form-control col-md-7 col-xs-12 js-example-basic-single">
                                        <option value="">Seleccione un modelo</option>
                                    </select>
                                    <?php if ($errors->has('modelo_id')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('modelo_id'); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Color <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="color_id" class="form-control col-md-7 col-xs-12 js-example-basic-single">
                                        <?php if($colores->count()>0): ?>
                                            <option value="">Seleccione un color</option>
                                            <?php $__currentLoopData = $colores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($color->id == old('color_id')): ?>
                                                    <option value="<?php echo e($color->id); ?>" selected><?php echo e($color->desc); ?></option>
                                                <?php else: ?>
                                                    <option value="<?php echo e($color->id); ?>"><?php echo e($color->desc); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            No existen colores
                                        <?php endif; ?>
                                    </select>
                                    <?php if ($errors->has('color_id')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('color_id'); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Capacidades <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="capacidad_id" class="form-control col-md-7 col-xs-12 js-example-basic-single">
                                        <?php if($capacidades->count()>0): ?>
                                            <option value="">Seleccione una capacidad</option>
                                            <?php $__currentLoopData = $capacidades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $capacidad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($capacidad->id == old('capacidad_id')): ?>
                                                    <option value="<?php echo e($capacidad->id); ?>" selected><?php echo e($capacidad->desc); ?></option>
                                                <?php else: ?>
                                                    <option value="<?php echo e($capacidad->id); ?>"><?php echo e($capacidad->desc); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            No existen capacidades
                                        <?php endif; ?>
                                    </select>
                                    <?php if ($errors->has('capacidad_id')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('capacidad_id'); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Proveedor <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="comprador" value="<?php echo e(old('comprador')); ?>" id="desc" class="form-control col-md-7 col-xs-12">
                                    <?php if ($errors->has('comprador')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('comprador'); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fecha compra <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="fecha_compra" value="<?php echo e(old('fecha_compra')); ?>" id="fecha_compra" class="form-control col-md-7 col-xs-12 date">
                                    <?php if ($errors->has('fecha_compra')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('fecha_compra'); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Precio compra <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="precio_compra" value="<?php echo e(old('precio_compra')); ?>" id="desc" class="form-control col-md-7 col-xs-12">
                                    <?php if ($errors->has('precio_compra')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('precio_compra'); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Imei <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="imei" id="desc" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Comprador <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="vendedor" id="desc" class="form-control col-md-7 col-xs-12">
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
                                    <input type="text" name="precio_venta" id="desc" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                    <a href="<?php echo e(url('/celulares')); ?>" class="btn btn-primary"><i class="fa  fa-times"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Aceptar</button>
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

        $('#fecha_compra').datetimepicker({
            format:'DD-MM-YYYY'
        });

        $('#fecha_venta').datetimepicker({
            format:'DD-MM-YYYY'
        });

        if($('#marca_id').val()!="")
        {
            $.get(
                    "<?php echo e(url('modelos/get_by_marca')); ?>",
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
                    "<?php echo e(url('modelos/get_by_marca')); ?>",
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\SellPhones\resources\views/celulares/create.blade.php ENDPATH**/ ?>