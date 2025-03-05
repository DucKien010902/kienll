<?php $__env->startSection('content'); ?>
<div class="row log-in">
    <div class="col-xxl-3 col-xl-4 col-lg-5 col-md-6 col-sm-8 form-login">
        <div class="card">
            <div class="card-body">
                <div class="title-3 text-start">
                    <h2>Đăng ký</h2>
                </div>
                <form  method="POST" action="<?php echo e(route('register')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i data-feather="user"></i>
                                </div>
                            </div>
                            <input id="name" type="text"  placeholder="Nhập họ tên" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name" value="<?php echo e(old('name')); ?>" required autocomplete="name" autofocus>
                           
                        </div>
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="important-note">
                            <strong><?php echo e($message); ?></strong>
                        </div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i data-feather="mail"></i>
                                </div>
                            </div>
                            <input id="email" type="email" placeholder="Nhập địa chỉ email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email">
                        </div>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="important-note">
                            <strong><?php echo e($message); ?></strong>
                        </div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i data-feather="lock"></i>
                                </div>
                            </div>
                            <input id="pwd-input" type="password"  placeholder="Nhập mật khẩu" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="new-password">
                            <div class="input-group-apend">
                                <div class="input-group-text">
                                    <i id="pwd-icon" class="far fa-eye-slash"></i>
                                </div>
                            </div>
                        </div>
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="important-note">
                            <strong><?php echo e($message); ?></strong>
                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i data-feather="lock"></i>
                                </div>
                            </div>
                            <input id="password-confirm" type="password" placeholder="Nhập lại mật khẩu" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            <div class="input-group-apend">
                            </div>
                        </div>
                    </div>
                    <div class="important-note">
                        Mật khẩu phải có tối thiểu 8 ký tự và phải chứa các chữ cái và số
                    </div>
                    <div>
                        <button type="submit" class="btn btn-gradient btn-pill color-2 me-sm-3 me-2">Tạo tài khoản</button>
                        <a href="<?php echo e(route('login')); ?>" class="btn btn-dashed btn-pill color-2">Đăng nhập</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
   
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <!--admin js -->
    <script src="<?php echo e(asset('assets/js/admin-script.js')); ?>"></script>

    <!-- login js -->
    <script src="<?php echo e(asset('assets/js/login.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Lập Trình Web PHP NC\Project_Laravel\Web_QL_PhongTro_L10\resources\views/auth/register.blade.php ENDPATH**/ ?>