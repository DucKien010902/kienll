<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo e(asset('assets/images/favicon.png')); ?>" type="image/x-icon" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,500,500i,600,600i,700,700i,800,800i"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i" rel="stylesheet">
    <!-- animate css -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/animate.css')); ?>">

    <!-- Template css -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/admin.css')); ?>">

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/sass/app.scss', 'resources/js/app.js']); ?>
</head>

<body>
    <?php echo $__env->make('layouts.components.load', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="page-wrapper">
        <div class="authentication-box">
            <div class="container-fluid">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>

    
    <!-- latest jquery-->
    <script src="<?php echo e(asset('assets/js/jquery-3.6.0.min.js')); ?>"></script>

    <!-- Bootstrap js-->
    <script src="<?php echo e(asset('assets/js/bootstrap.bundle.min.js')); ?>"></script>

    <!-- feather icon js-->
    <script src="<?php echo e(asset('assets/js/feather-icon/feather.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/feather-icon/feather-icon.js')); ?>"></script>

    <?php echo $__env->yieldContent('js'); ?>
</body>

</html>
<?php /**PATH E:\laragon\www\phongtro20\resources\views/dashboard/auth.blade.php ENDPATH**/ ?>