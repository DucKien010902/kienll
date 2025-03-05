<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sheltos - Modern home page">
    <meta name="keywords" content="sheltos">
    <meta name="author" content="sheltos">
    <link rel="icon" href="<?php echo e(asset('assets/images/logo/favicon.png')); ?>" type="image/x-icon" />
    <title>PHONGTRO20 - Tìm phòng đơn giản, thuê phòng giản đơn</title>
   
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
   <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,500,500i,600,600i,700,700i,800,800i"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Itim&family=Roboto+Slab:wght@400;800&display=swap" rel="stylesheet">

    <!-- range slider css -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/jquery-ui.css')); ?>">

    <!-- magnific css -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/magnific-popup.css')); ?>">

    <!-- animate css -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/animate.css')); ?>">

    <!-- Template css -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/bootstrap.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/color1.css')); ?>">
    <?php echo $__env->yieldContent('style'); ?>
</head>

<body class="layout-bg">
    
    <?php echo $__env->make('frontend.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('content'); ?>
    <?php echo $__env->make('frontend.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('frontend.components.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('modal'); ?>
    <?php echo $__env->make('frontend.components.taptotop', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('customiez'); ?>
    
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
     <!-- latest jquery-->
     <script src="<?php echo e(asset('assets/js/jquery-3.6.0.min.js')); ?>"></script>

     <!-- popper js-->
     <script src="<?php echo e(asset('assets/js/popper.min.js')); ?>"></script>
     <?php echo $__env->yieldContent('js'); ?>
     <!-- magnific js -->
     <script src="<?php echo e(asset('assets/js/jquery.magnific-popup.js')); ?>"></script>
     <script src="<?php echo e(asset('assets/js/zoom-gallery.js')); ?>"></script>
 
 
         <!-- range slider js -->
     <script src="<?php echo e(asset('assets/js/jquery-ui.js')); ?>"></script>
     <script src="<?php echo e(asset('assets/js/jquery.ui.touch-punch.min.js')); ?>"></script>
    
 
     <!-- Bootstrap js-->
     <script src="<?php echo e(asset('assets/js/bootstrap.bundle.min.js')); ?>"></script>
 
 
     <!-- feather icon js-->
     <script src="<?php echo e(asset('assets/js/feather-icon/feather.min.js')); ?>"></script>
     <script src="<?php echo e(asset('assets/js/feather-icon/feather-icon.js')); ?>"></script>
 
     <!-- video js-->
     <script src="<?php echo e(asset('assets/js/jquery.vide.min.js')); ?>"></script>
 
     <!-- wow js-->
     <script src="<?php echo e(asset('assets/js/wow.min.js')); ?>" ></script>
 
     <!-- slick js -->
     <script src="<?php echo e(asset('assets/js/slick.js')); ?>"></script>
     <script src="<?php echo e(asset('assets/js/slick-animation.min.js')); ?>"></script>
     <script src="<?php echo e(asset('assets/js/custom-slick.js')); ?>"></script>
 
     <!-- Template js-->
     <script src="<?php echo e(asset('assets/js/script.js')); ?>"></script>

     <script src="<?php echo e(asset('assets/js/login.js')); ?>"></script>
 
     <!-- Customizer js-->
     <script src="<?php echo e(asset('assets/js/customizer.js')); ?>"></script>
 
     <!-- Color-picker js-->
     <script src="<?php echo e(asset('assets/js/color/template-color.js')); ?>"></script>
     <script src="<?php echo e(asset('assets/js/color/layout10.js')); ?>"></script>
    

    
    <!-- latest jquery-->
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
   <?php 
   if(Session::get('toast') !== null) {
    $toast = Session::get('toast');
    
   }
    
   ?>
    <?php if(isset($toast)): ?>
    <script>
        makeToast("<?php echo e($toast[0]); ?>","<?php echo e($toast[1]); ?>")
    </script>
    <?php endif; ?>
 
</body>

</html>
<?php /**PATH D:\Lập Trình Web PHP NC\Project_Laravel\Web_QL_PhongTro_L10\resources\views/layouts/app.blade.php ENDPATH**/ ?>