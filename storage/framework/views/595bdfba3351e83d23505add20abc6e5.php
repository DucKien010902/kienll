<?php $__env->startSection('content'); ?>
    <div class="row log-in">
        <div class="col-xxl-3 col-xl-4 col-lg-5 col-md-6 col-sm-8 form-login">
            <div class="card">
                <div class="card-body">
                    <div class="title-3 text-start">
                        <h2>Quên mật khẩu</h2>
                    </div>
                    <form method="POST" action="<?php echo e(route('password.email')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i data-feather="user"></i>
                                    </div>
                                </div>
                                <input id="email" type="email"
                                    class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email"
                                    value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus
                                    placeholder="Nhập email">

                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-gradient btn-pill color-2 me-sm-3 me-2">Gửi yêu cầu</button>
                        </div>
                    </form>

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

<?php echo $__env->make('dashboard.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\phongtro20\resources\views/auth/passwords/email.blade.php ENDPATH**/ ?>