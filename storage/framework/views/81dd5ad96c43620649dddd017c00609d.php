

<?php $__env->startSection('content'); ?>
    <div class="row container">
        <div class="col-lg-3 bg-light">
            <h1 class="page-header text-header">Tài khoản của bạn đã bị chặn</h1>
            <div class="mt-2 ">
                <strong>Tại sao tài khoản của tôi bị chặn ?</strong>
                <p>Tài khoản của bạn đã có những hành vi làm ảnh hưởng đến hoạt động và mục tiêu của website. Vì vậy quản trị viên đã chặn tài khoản của bạn</p>
            </div>
            <div>
                <a href="<?php echo e(route('logout')); ?>"
                onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">Đăng xuất<i data-feather="log-out"></i></a>
            </div>
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                <?php echo csrf_field(); ?>
            </form>
          
        </div>
        <div class="col-lg-9">
            <div class="col-lg-12">
                <img class="img-fluid" src="<?php echo e(asset('images/errors/block.png')); ?>" alt="">
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

<?php echo $__env->make('dashboard.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\phongtro20\resources\views/errors/block.blade.php ENDPATH**/ ?>