<?php $__env->startSection('content'); ?>
<?php if($ultima_cotizacion == null): ?>
<div class="alert alert-warning" role="alert">
   <h4>No existe cotizacion del dolar debe crearla antes de realizar una venta</h4>
  </div>
 <?php endif; ?>
 <?php if ($errors->has('observacion')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('observacion'); ?>
 <div class="alert alert-danger"><h4><?php echo e($message); ?></h4></div>
 <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
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
                                <?php if($ultima_cotizacion != null): ?>
                                <th width="50px">
                                    <a class="btn btn-primary btn-xs" href="<?php echo e(url('ventas/create')); ?>">Adicionar venta</a>
                                </th>
                                <?php endif; ?>
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
                            <?php $__currentLoopData = $ventas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $venta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <a href="<?php echo e(url('/ventas/edit/'.$venta->id)); ?>" class="btn btn-default btn-xs btn-detail">Editar</a>
                                        <!-- Button trigger modal -->
                                        <div>
                                        <button type="button" class="btn btn-danger btn-xs btn-delete" data-toggle="modal" data-target="#exampleModal<?php echo e($venta->id); ?>">
                                        Eliminar
                                        </button>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal" id="exampleModal<?php echo e($venta->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModal<?php echo e($venta->id); ?>" aria-hidden="true">
                                        <div class="modal-dialog " role="document" >
                                            <div class="modal-content">
                                            <div class="modal-header ">
                                                <h5 class="modal-title col-md-10" id="exampleModalLabel">Eliminar Venta</h5>
                                                <button type="button" class="close" aria-label="Close" >
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="<?php echo e($venta->id); ?>" class="form-horizontal form-label-left input_mask" method="POST" action="<?php echo e(url('/ventas/destroy/'.$venta->id)); ?>" >
                                                        <?php echo csrf_field(); ?>
                                                         <?php echo e(method_field('DELETE')); ?>

                                                        <label for="recipient-name" class="control-label col-md-2 col-sm-2 col-xs-10">Motivo:</label>
														<input id="<?php echo e($venta->id); ?>" type="hidden" value="<?php echo e($venta->id); ?>">
                                                        <textarea  class="form-control col-md-6 col-xs-12" name="observacion" id="observacion" rows="2"></textarea>
                                                            <div class="col-md-offset-7 col-md-9 col-sm-9 col-xs-12 ">
                                                                <a href="<?php echo e(url('/ventas')); ?>" class="btn btn-primary"><i class="fa  fa-times"></i> Cancelar</a>
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
                                <td><?php echo e($venta->imei); ?></td>
                                <td><?php echo e($venta->precio_dollar); ?></td>
                                <td><?php echo e($venta->precio); ?></td>
                                <td><?php echo e($venta->precio_venta); ?></td>
                                <td><?php echo e($venta->vendedor); ?></td>
                                <td><?php echo e($venta->nombre); ?></td>
                                <td><?php echo e($venta->telefono); ?></td>
                                <td><?php echo e($venta->email); ?></td>
                                <td><?php echo e($venta->metodo_pago); ?></td>
                                <td><?php echo e($venta->observacion); ?></td>
                                <td><?php echo e($venta->usuario); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>


    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>

        jQuery(document).ready(function($){

            $('#table_ventas').dataTable({
                "language" : {
                    "url":'lan/spanish.json'
                }
            });

        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\resources\views/ventas/index.blade.php ENDPATH**/ ?>