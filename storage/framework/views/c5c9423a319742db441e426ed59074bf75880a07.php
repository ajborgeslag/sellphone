<?php $__env->startSection('content'); ?>
    <div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Cotizaciones</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="table_cotizaciones" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="50px">
                                    <a class="btn btn-primary btn-xs" href="<?php echo e(url('cotizacion/create')); ?>">Adicionar cotizacion</a>
                                </th>
                                <th>Valor</th>
                                <th>Fecha</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $cotizaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cotizacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($cotizacion->usado === 0): ?>
                                <tr>
                                        <td>
                                            <a href="<?php echo e(url('/cotizacion/edit/'.$cotizacion->id)); ?>" class="btn btn-default btn-xs btn-detail">Editar</a>
                                            <form method="POST" onsubmit="return confirm('Está seguro que desea eliminar la cotizacion !');" action="<?php echo e(url('/cotizacion/destroy/'.$cotizacion->id)); ?>">
                                                <?php echo csrf_field(); ?>
                                                <?php echo e(method_field('DELETE')); ?>

                                                <button id="delete"  type="submit"  class="btn btn-danger btn-xs btn-delete">Eliminar</button>
                                            </form>
                                        </td>
                                        <td><?php echo e($cotizacion->valor); ?></td>
                                        <td><?php echo date('d-m-Y h:i:s',strtotime($cotizacion->fecha))?></td>
                                </tr>
                                <?php else: ?>
                                <tr>
                                        <td>

                                        </td>
                                        <td><?php echo e($cotizacion->valor); ?></td>
                                        <td><?php echo date('d-m-Y h:i:s',strtotime($cotizacion->fecha))?></td>
                                </tr>
                                <?php endif; ?>
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

            $('#table_cotizaciones').dataTable({
                "language" : {
                    "url":'lan/spanish.json'
                },
				"order":[2,"desc"]
            });
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\resources\views/cotizacion/index.blade.php ENDPATH**/ ?>