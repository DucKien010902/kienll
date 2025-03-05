
<?php $__env->startSection('style'); ?>
<style>
.btn-to-right {
    float: right;
}

</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Container-fluid start -->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-header-left">
                        <h3>Thông tin tài khoản
                           <small>
                            Chào mừng bạn đến trang quản lý tài khoản cá nhân
                        </small> 
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid end -->
   <!-- Container-fluid start -->
   <div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="row user-info">
                <div class="col-xl-5 xl-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="media contact-media">
                                <img src="<?php echo e(asset('images/user_avatar/' . $user->profile_photo_path)); ?>" class="img-fluid img-80" alt="">
                                <div class="media-body">
                                    <h4><?php echo e($user->name); ?></h4>
                                    <span class="light-font"><?php echo e(json_decode($user->address)->address); ?></span>
                                    <ul class="agent-social mt-2">
                                        <li><a href="<?php echo e($user->Facebook); ?>" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="https://zalo.me/<?php echo e($user->Zalo); ?>" target="_blank" class="twitter">Zalo</a></li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="contact-btn">
                                
                                <a href="<?php echo e(route('user.edit',$user->id)); ?>" class="btn btn-dashed color-4 ms-2 btn-pill">Cập nhật thông tin cá nhân</a>
                            </div>
                        </div>
                    </div>
                </div>
               
                <div class="col-xl-4 xl-6 col-md-6">
                    <div class="about-profile">
                        <div class="about-info">
                            <div class="card">
                                <div class="card-body">
                                    <div class="title-about">
                                        <h5>Giới thiệu</h5>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordernone mb-0">
                                            <tbody>
                                                <tr>
                                                    <td>Email:</td>
                                                    <td class="light-font"><?php echo e($user->email); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Mobile Number:</td>
                                                    <td class="light-font"><?php echo e($user->PhoneNumber); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Vai trò:</td>
                                                    <td class="light-font"><?php echo e($user->role == 1 ? 'Admin' : "Chủ trọ"); ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-6 xl-6 col-lg-12 col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="recent-properties">
                                <div class="title-about">
                                    <h5>Đổi mật khẩu</h5>
                                </div>
                                <form action="<?php echo e(route('profile.doiMatKhau')); ?>" method="post" class="form-horizontal">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group">
                                        <label for="passwordOld" >Mật khẩu cũ</label>
                                        <input type="password" class="form-control" value="<?php echo e(old('OldPassword')); ?>" name="OldPassword" id="passwordOld" required>
                                        <?php $__errorArgs = ['OldPassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback">
                                           <?php echo e($message); ?>

                                          </div>    
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="passwordNew">Mật khẩu mới</label>
                                        <input type="password" class="form-control" value="<?php echo e(old('NewPassword')); ?>" name="NewPassword" id="passwordNew" required>
                                       
                                    </div>
                                    <div class="form-group">
                                        <label for="passwordConfirm">Nhập lại mật khẩu mới</label>
                                        <input type="password" class="form-control" value="<?php echo e(old('NewPassword_confirmation')); ?>" name="NewPassword_confirmation" id="passwordConfirm" required>
                                      
                                    </div>
                                    <button type="submit" class="btn btn-primary">Thay đổi</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 xl-6 col-md-12">
                    <div class="row">
                        <div class="buyer-chart col-xl-12 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="title-about">
                                        <h5>Mô tả</h5>
                                    </div>
                                    <div class="total-container">
                                        <?php echo $user->description; ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>
</div>
<!-- Container-fluid end --> 
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

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\tai_lieu_hoc_tap\nhap_mon_cnpm\Web_QL_PhongTroBK\resources\views/dashboard/profile/index.blade.php ENDPATH**/ ?>