
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
                        <h3>Sửa loại phòng trọ
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
                        <h5>Điền thông tin loại phòng</h5>
                    </div>
                    <div class="card-body admin-form">
                        <form id="form_create" method="POST" action="<?php echo e(route('categorynews.update', $data->id)); ?>" class="row gx-3">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field("put"); ?>
                            <input type="text" name="id" value="<?php echo e($data->id); ?>" class="form-control d-none">
                            <div class="form-group col-md-12 col-sm-12">
                                <label>Tên loại phòng <span class="font-danger">*</span></label>
                                <input type="text" name="name" value="<?php echo e(old('name') ? old('name') : $data->name); ?>"
                                    id="name_room" class="form-control" required>
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Mô tả</label>
                                <textarea class="form-control" name="description" rows="4"><?php echo e(old('description') ? old('description') : $data->description); ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\phongtro20\resources\views/dashboard/categorynews/edit.blade.php ENDPATH**/ ?>