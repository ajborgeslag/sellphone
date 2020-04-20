<?php $__env->startSection('content'); ?>
    <div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Roles</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <?php if($errors->any()): ?>
                                <div class="alert alert-danger"><?php echo e($errors->first()); ?></div>
                            <?php endif; ?>
                        </div>
                        <table id="table_roles" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="50px"><a class="btn btn-primary btn-xs" href="<?php echo e('roles/create'); ?>">Adicionar Rol</a></th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <a href="<?php echo e(url('/roles/edit/'.$rol->id)); ?>" class="btn btn-default btn-xs btn-detail">Editar</a>
                                    <form method="POST" action="<?php echo e(url('/roles/destroy/'.$rol->id)); ?>">
                                        <?php echo csrf_field(); ?>
                                        <?php echo e(method_field('DELETE')); ?>

                                        <button type="submit" class="btn btn-danger btn-xs btn-delete">Eliminar</button>
                                    </form>
                                </td>
                                <td><?php echo e($rol->name); ?></td>
                                <td><?php echo e($rol->description); ?></td>
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

            $('#table_roles').dataTable({
                "language" : {
                    "url":'lan/spanish.json'
                }
            });



        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\resources\views/roles/index.blade.php ENDPATH**/ ?>