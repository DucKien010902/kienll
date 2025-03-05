
<?php $__env->startSection('style'); ?>
    <style>
        .btn-to-right {
            float: right;
        }

        .image_edit {
            max-height: 300px;
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
                        <h3>Gửi thông báo
                            <small>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo e(route('home')); ?>">
                                            <i class="fa fa-home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item ">- Quản lý tài khoản</li>
                                </ol>
                            </small>
                        </h3>
                    </div>
                </div>
                <div class="col-sm-6">

                    <a href="<?php echo e(route('account.index')); ?>" class="btn btn-outline-warning btn-to-right">Quay lại</a>

                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid end -->

    <!-- Container-fluid start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Nhập nội dung bạn muốn gửi cho <?php echo e($user->name); ?></h5>
                    </div>
                    <div class="card-body admin-form">
                        <form id="form_create" method="POST" action="<?php echo e(route('account.sendNotification', $user->id)); ?>"
                            class="row gx-3">
                            <?php echo csrf_field(); ?>
                            <div class="form-group col-md-6 col-sm-12">
                                <label>Nội dung <span class="font-danger">*</span></label>
                                <input type="text"  name="message" value="" id="name_room"
                                    class="form-control" required>
                            </div>
                            <div class="col-sm-12 d-flex flex-end">
                                <button type="submit" class="btn btn-primary" >Gửi thông báo</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid end -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <?php $__errorArgs = ['name'];
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
    <?php $__errorArgs = ['description'];
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
    <script>
        function submitform() {
            // Get first form element
            var $form = $('#form_create')[0];

            // Check if valid using HTML5 checkValidity() builtin function
            if ($form.checkValidity()) {
                console.log('valid');
                $form.submit();
            } else {
                makeToast('Bạn cần nhập đầy đủ các trường', 'red')
            }

            return false
        }
    </script>
    <script>
        function makeToast(title, color = "green") {
            Toastify({
                text: title,
                className: "info",
                style: {
                    background: color,
                }
            }).showToast();
        }
    </script>
    <!-- Dropzone js -->


    <script src="<?php echo e(asset('assets/js/dropzone/dropzone.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\tai_lieu_hoc_tap\nhap_mon_cnpm\Web_QL_PhongTro_L10\resources\views/dashboard/account/sendNotification.blade.php ENDPATH**/ ?>