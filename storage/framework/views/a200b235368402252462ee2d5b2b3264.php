
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
                        <h3>Sửa tài khoản
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
                        <h5>Thông tin người dùng</h5>
                    </div>
                    <div class="card-body admin-form">
                        <form id="form_create" method="POST" action="<?php echo e(route('account.edit', $user->id)); ?>"
                            class="row gx-3">
                            <?php echo csrf_field(); ?>
                            <div class="form-group col-md-6 col-sm-12">
                                <label>Email <span class="font-danger">*</span></label>
                                <input type="text" disabled name="email" value="<?php echo e(old('email') ? old('email') :$user->email); ?>" id="name_room"
                                    class="form-control" required>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label>Facebook <span class="font-danger">*</span></label>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <input type="text" name="Facebook" value="<?php echo e(old('Facebook') ? old('Facebook') :$user->Facebook); ?>" id="name_room"
                                            class="form-control" required>
                                    </div>
                                    <a href="<?php echo e($user->Facebook); ?>" class="btn btn-info col-sm-4">Kiểm tra</a>

                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label>Zalo <span class="font-danger">*</span></label>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <input type="text" name="Zalo" value="<?php echo e(old('Zalo') ? old('Zalo') : $user->Zalo); ?>" id="name_room"
                                            class="form-control " required>
                                    </div>
                                    <a href="https://zalo.me/<?php echo e($user->Zalo); ?>" class="btn btn-info col-sm-4">Kiểm tra</a>
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label>Tên Người dùng <span class="font-danger">*</span></label>
                                <input type="text" name="name" value="<?php echo e(old('name') ? old('name') : $user->name); ?>"
                                    id="name_room" class="form-control" required>

                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label>vai trò <span class="font-danger">*</span></label>
                                <select class="dropdown col-12 p-2" name="role" id="">
                                    <option value="0" <?php echo e($user->status == 0 ? "checked" : ''); ?>>Người dùng</option>
                                    <option value="0" <?php echo e($user->status == 1 ? "checked" : ''); ?>>Chủ trọ</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label>Lý do  cập nhật <span class="font-danger">*</span></label>
                                <input type="text" name="ly_do" value="" placeholder="nhập lý do"
                                    id="name_room" class="form-control" required>
                            </div>
                            <div class="col-sm-12 d-flex flex-end">

                                <button type="submit" class="btn btn-primary" >Cập nhật</button>
            
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

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\phongtro20\resources\views/dashboard/account/edit.blade.php ENDPATH**/ ?>