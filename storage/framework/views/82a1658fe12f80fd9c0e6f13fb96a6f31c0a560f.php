<?php $__env->startSection('content'); ?>
<?php if($ultima_cotizacion == null): ?>
<div class="alert alert-warning" role="alert">
   <h4>No existe cotizacion del dolar debe crearla antes de realizar una operacion de caja</h4>
  </div>
 <?php endif; ?>
<div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Caja</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <div class="x_content">
                        <form class="form-inline" method="POST" action="<?php echo e(url('caja/')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="form-group mx-sm-3 mb-2">
                                <input type="text" class="form-control input-sm" id="search_fecha" name="search_fecha" placeholder="Filtrar por fecha">
                            </div>
                            <button type="submit" class="btn btn-success btn-xs" name="submitbtn" value="aceptar">Buscar</button>
                        </form>
                        <br />
                    <table id="table_caja" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <?php if($ultima_cotizacion != null): ?>
                                <th width="50px">
                                    <a class="btn btn-primary btn-xs" href="<?php echo e(url('caja/create')); ?>">Adicionar</a>
                                </th>
                                <?php endif; ?>
                                <th>Fecha</th>
                                <th>Saldo dolar</th>
                                <th>Saldo pesos</th>
                                <th>Saldo final</th>
                                <th>Observacion</th>
                                <th>Concepto</th>
                                <th>Usuario</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $cajas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $caja): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($hoy===1): ?>
                            <tr>
                                <?php if(($caja->venta_id == null)&& ($caja->concepto== 'Egreso')): ?>
                                <td>
                                    <form method="POST" onsubmit="return confirm('Está seguro que desea eliminar !');"
                                        action="<?php echo e(url('/caja/destroy/'.$caja->id)); ?>">
                                        <?php echo csrf_field(); ?>
                                        <?php echo e(method_field('DELETE')); ?>

                                        <button id="delete" type="submit"
                                            class="btn btn-danger btn-xs btn-delete">Eliminar</button>
                                    </form>
                                </td>
                                <?php elseif(($caja->venta_id != null)&& ($caja->concepto== 'Ingreso')): ?>
                                <td>
                                    <a href="<?php echo e(url('/ventas/edit/'.$caja->venta_id)); ?>"
                                        class="btn btn-default btn-xs btn-detail">Editar</a>
                                </td>
                                <?php else: ?>
                                <td></td>
                                <?php endif; ?>
                                <td><?php
                                    if($caja->fecha=='0000-00-00'){
                                        echo '';
                                    }else{
                                        echo date('d-m-Y h:i:s',strtotime($caja->fecha));
                                    }
                                    ?>
                                </td>
                                <td><?php echo e($caja->saldo_dollar); ?></td>
                                <td><?php echo e($caja->saldo_pesos); ?></td>
                                <td><?php echo e($caja->saldo_final); ?></td>
                                <td><?php echo e($caja->observacion); ?></td>
                                <td><?php echo e($caja->concepto); ?></td>
                                <td><?php echo e($caja->usuario); ?></td>

                            </tr>
                            <?php else: ?>
                            <tr>
                                <td>

                                </td>
                                <td><?php
                                    if($caja->fecha=='0000-00-00'){
                                        echo '';
                                    }else{
                                        echo date('d-m-Y h:i:s',strtotime($caja->fecha));
                                    }
                                    ?>
                                </td>
                                <td><?php echo e($caja->saldo_dollar); ?></td>
                                <td><?php echo e($caja->saldo_pesos); ?></td>
                                <td><?php echo e($caja->saldo_final); ?></td>
                                <td><?php echo e($caja->observacion); ?></td>
                                <td><?php echo e($caja->concepto); ?></td>
                                <td><?php echo e($caja->usuario); ?></td>
                            </tr>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                   </div>
                   <!--Totales-->
                   <div class="row">
                    <div class="col-md-5 ml-md-auto"></div>
                    <div class="col-md-3 ml-md-auto">
                        <label>Dolar:</label>
                        <label><?php echo e($total_dollar); ?></label>
                    </div>
                    <div class="col-md-4 ml-md-auto">
                        <label>Pesos:</label>
                        <label><?php echo e($total_pesos); ?></label>
                    </div>
				   </div>
				   <div class="row">
                    <div class="col-md-5 ml-md-auto"></div>
                    <div class="col-md-3 ml-md-auto">
                        <label>Dolar General:</label>
                        <label><?php echo e($total_dollar_general); ?></label>
                    </div>
                    <div class="col-md-4 ml-md-auto">
                        <label>Pesos General:</label>
                        <label><?php echo e($total_pesos_general); ?></label>
                    </div>
				   </div>
                   <!--Fin-->
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>

    jQuery(document).ready(function ($) {
        $('#search_fecha').datetimepicker({
            format: 'DD-MM-YYYY'

        });

        $('#table_caja').dataTable({
            "language": {
                "url": 'lan/spanish.json'
            }
        });

    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\resources\views/caja/index.blade.php ENDPATH**/ ?>