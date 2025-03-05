

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
 <!-- section start -->
 <section class="login-wrap">
    <div class="container">
        <div class="row log-in">
            <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 col-12">
                <div class="theme-card">
                <div class="title-3 text-start">
                    <h2>Đổi mật khẩu</h2>
                </div>
                <form action="<?php echo e(route('profile.doiMatKhau')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i data-feather="lock"></i>
                                </div>
                            </div>
                            <input type="password" class="form-control" value="<?php echo e(old('OldPassword')); ?>" placeholder="Mật khẩu cũ" name="OldPassword" id="passwordOld" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i data-feather="lock"></i>
                                </div>
                            </div>
                            <input type="password" class="form-control" value="<?php echo e(old('NewPassword')); ?>" placeholder="Mật khẩu mới"  name="NewPassword" id="pwd-input" required>
                            
                            <div class="input-group-apend">
                                <div class="input-group-text">
                                    <i id="pwd-icon" class="far fa-eye-slash"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i data-feather="lock"></i>
                                </div>
                            </div>
                            <input type="password" class="form-control" value="<?php echo e(old('NewPassword_confirmation')); ?>" placeholder="Nhập lại mật khẩu mới" name="NewPassword_confirmation" id="passwordConfirm" required>

                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-gradient btn-pill color-2 me-sm-3 me-2">Đổi mật khẩu</button>
                    </div>
                    
                </form>
            </div>
            </div>
        </div>
    </div>
</section>
<!-- section end -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<?php $__errorArgs = ['NewPassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
<script>
    Toastify({
     text: "<?php echo e($message); ?>",
     className: "info",
     style: {
         background: "red",
         }
 }).showToast();
 </script>   
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

<?php $__errorArgs = ['OldPassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
<script>
    Toastify({
     text: "<?php echo e($message); ?>",
     className: "info",
     style: {
         background: "red",
         }
 }).showToast();
 </script>   
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\phongtro20\resources\views/frontend/user/changepassword.blade.php ENDPATH**/ ?>