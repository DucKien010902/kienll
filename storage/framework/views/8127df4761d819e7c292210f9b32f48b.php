
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
                        <h3>Tạo loại phòng trọ
                           <small>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo e(route('home')); ?>">
                                        <i class="fa fa-home"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item ">- Quản lý loại phòng</li>
                            </ol>    
                        </small> 
                        </h3>
                    </div>
                </div>
                <div class="col-sm-6">

                    <a href="<?php echo e(route('loai_phong')); ?>" class="btn btn-outline-warning btn-to-right">Quay lại</a>
                    
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
                        <h5>Điền thông tin loại phòng mới</h5>
                    </div>
                     <div class="card-body admin-form">
                        <form id="form_create" method="POST" action="<?php echo e(route('luu_loai_phong')); ?>" class="row gx-3">
                            <?php echo csrf_field(); ?>
                            <div class="form-group col-md-12 col-sm-12">
                                <label>Tên loại phòng <span class="font-danger">*</span></label>
                                <input type="text" name="name" value="<?php echo e(old('name')); ?>" id="name_room" class="form-control"  required>
                               
                            </div>
                            
                            <div class="form-group col-sm-12">
                                <label>Mô tả</label>
                                <textarea class="form-control" name="description"   rows="4"><?php echo e(old('description')); ?></textarea>
                            </div>
                            <div class="form-group col-md-12 col-sm-12 d-none">
                                <label>Tên loại phòng <span class="font-danger">*</span></label>
                                <input type="text" name="path_img" id="path_img" class="form-control" >
                               
                            </div>
                        </form>
                        <div class="dropzone-admin mb-0">
                            <label>Ảnh đại diện</label>
                            <form class="dropzone" id="singleFileUpload" action="<?php echo e(route('upload_anh_loai_phong')); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="dz-message needsclick"><i class="fas fa-cloud-upload-alt"></i>
                                <h6>Thả ảnh hoặc nhấn vào đây để upload.</h6>
                                </div>
                            </form>
                        </div>
                        <div class="form-btn">
                            <button type="submit" onclick="submitform()" class="btn btn-pill btn-gradient color-4">Lưu</button>
                            <a href="<?php echo e(route('loai_phong')); ?>" class="btn btn-pill btn-dashed color-4">Quay lại</a>
                            
                        </div>
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
    } 
    
    else {
        makeToast('Bạn cần nhập đầy đủ các trường','red')
    }
    
    return false
    }
</script>
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
    <!-- Dropzone js -->
    <script src="<?php echo e(asset('assets/js/dropzone/dropzone.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/dropzone/dropzone-script.js')); ?>"></script>

    <!-- datepicker js-->
    <script src="<?php echo e(asset('assets/js/date-picker.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\phongtro20\resources\views/dashboard/categoryroom/create.blade.php ENDPATH**/ ?>