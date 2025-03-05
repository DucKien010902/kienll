<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Sheltos - Admin dashboard page">
        <meta name="keywords" content="sheltos">
        <meta name="author" content="sheltos">
        <link rel="icon" href="<?php echo e(asset('assets/images/favicon.png')); ?>" type="image/x-icon" />
        <title>Trang Tổng Quan</title>
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <!--Google font-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,500,500i,600,600i,700,700i,800,800i"
        rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
     <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i" rel="stylesheet">
        <!-- animate css -->
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/animate.css')); ?>">
    
        <!-- Template css -->
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/admin.css')); ?>">
        <!-- Styles -->
       <?php echo $__env->yieldContent('style'); ?>
    </head>
    <body>
        <?php echo $__env->make('layouts.components.load', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="page-wrapper">
            <?php echo $__env->make('layouts.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="page-body-wrapper">
                <?php echo $__env->make('layouts.components.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="page-body">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
                <?php echo $__env->make('layouts.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
        <?php echo $__env->make('layouts.components.taptotop', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('layouts.components.customizer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
         <!-- customizer end -->
         <script>
            function makeToast(title,color = "green") {
                Toastify({
            text: title,
            className: "info",
            style: {
                background: color,
                }
    }).showToast();
            }
        </script>
        <?php echo $__env->yieldContent('js'); ?>
    <!-- latest jquery-->
    <script src="<?php echo e(asset('assets/js/jquery-3.6.0.min.js')); ?>"></script>

    <!-- Bootstrap js-->
    <script src="<?php echo e(asset('assets/js/bootstrap.bundle.min.js')); ?>"></script>

    <!-- feather icon js-->
    <script src="<?php echo e(asset('assets/js/feather-icon/feather.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/feather-icon/feather-icon.js')); ?>"></script>

    <!-- sidebar js -->
    <script src="<?php echo e(asset('assets/js/sidebar.js')); ?>"></script>

    <!-- apex chart js-->
    <script src="<?php echo e(asset('assets/js/chart/apex-chart/apex-chart.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/chart/apex-chart/stock-prices.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/admin-dashboard.js')); ?>"></script>

    <!--admin js -->
    <script src="<?php echo e(asset('assets/js/admin-script.js')); ?>"></script>

    <!-- Customizer js-->
    <script src="<?php echo e(asset('assets/js/customizer.js')); ?>"></script>

    

    <?php if(isset($toast)): ?>
    <script>
        makeToast("<?php echo e($toast[0]); ?>","<?php echo e($toast[1]); ?>")
    </script>
    <?php endif; ?>
    </body>
</html>
<?php /**PATH E:\laragon\www\phongtro20\resources\views/dashboard.blade.php ENDPATH**/ ?>