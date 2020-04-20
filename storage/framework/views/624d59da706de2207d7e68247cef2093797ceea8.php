<?php $__env->startSection('content'); ?>
<div ng-controller="loginController as showCase" class="limiter">
	<div class="container-login100">
		<div class="wrap-login100">
			<form name="Loginform" class="login100-form validate-form" method="POST" action="<?php echo e(url('/register')); ?>" novalidate>
			<div class="logo-login"><img src="<?php echo e(asset('images/logo.png')); ?>" alt=""></div>
			<?php echo e(csrf_field()); ?>

				<span class="login100-form-title p-b-34">
					Acceso a clientes
				</span>
				<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Error de Email">
				    <input id="email" type="email" ng-mouseout="validateForm('email')" name="email" class="input100" ng-model="formLogin.email"  placeholder="Email" required>
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Error de Contraseña">
					<input  class="input100" id="password" type="password" ng-mouseout="validateForm('password')" name="password" ng-model="formLogin.password" placeholder="Contraseña" required>
					<span class="focus-input100"></span>
				</div>
				<?php if(!empty($errorEmail)): ?>
                <div class="form-error">
                    <span>
                        <strong><?php echo e($errorEmail); ?></strong>
                    </span>
                </div>
                <?php endif; ?>
				<div class="container-login100-form-btn">
					<button type="submit" class="login100-form-btn" ng-disabled="Loginform.$invalid">
						Ingresar
					</button>
				</div>
            </form>

			<div class="login100-more" style="background-image: url('images/bg-01.jpg');"></div>
		</div>
	</div>
</div>
<!--<div ng-controller="loginController as showCase" class="limiter">
	<div class="container-login100">
		<div class="wrap-login100">
			<form id="validate-form" class="login100-form validate-form">
				<span class="login100-form-title p-b-34">
					Loguin
				</span>
				
				<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Error de Email">
					<input id="usuario" class="input100" type="email" ng-model="formLogin.email"  name="usuario" placeholder="Email">
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Error de Contraseña">
					<input class="input100" type="password" name="contrasena" ng-model="formLogin.password" placeholder="Contraseña">
					<span class="focus-input100"></span>
				</div>
				
				<div class="container-login100-form-btn">
					<button type="button" ng-click="login()" class="login100-form-btn">
						Registrarse
					</button>
				</div>

				<div class="w-full text-center p-t-27 p-b-239">
					<span class="txt1">
						Recuperar
					</span>

					<a href="#" class="txt2">
						Usuario / contraseña?
					</a>
				</div>

				<div class="w-full text-center">
					<a href="#" class="txt3">
						Sign Up
					</a>
				</div>
			</form>

			<div class="login100-more" style="background-image: url('images/bg-01.jpg');"></div>
		</div>
	</div>
</div>-->
<!--<div class="container">
	<div class="card card-container">
	<img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
    <p id="profile-name" class="profile-name-card"></p>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/login')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-10 control-label">E-Mail Address</label>

                            <div class="col-md-10">
                                <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required autofocus>

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label for="password" class="col-md-10 control-label">Password</label>

                            <div class="col-md-10">
                                <input id="password" type="password" class="form-control" name="password" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-2">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
							</div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
	</div>
</div>-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\resources\views/seguridad/loguin.blade.php ENDPATH**/ ?>