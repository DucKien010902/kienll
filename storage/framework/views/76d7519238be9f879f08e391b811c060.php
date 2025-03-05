
<?php $__env->startSection('style'); ?>
    <style>
        .btn-to-right {
            float: right;
        }
        .btn-table {
            max-width: 80px;
           
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
                        <h3>Thể loại
                            <small>
                                
                            </small>
                        </h3>
                    </div>
                </div>
                <div class="col-sm-6">
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid end -->
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5 class="mb-4 text-center bg-success text-white ">Thêm thể loại mới</h5>
                <form action="<?php echo e(route('categorynew.store')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="">
                        <label for="nameInput">Tên thể loại</label>
                        <input type="text" id="nameInput" class="form-control" name="name" required placeholder="" value="<?php echo e(old('name') ? old('name') : ''); ?>">
                        
                    </div>
                    <div class="form-group">
                        <label for="">Mô tả</label>
                        <input type="text" class="form-control" required name="description" placeholder="">
                        <?php $__errorArgs = ['description'];
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
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </form>
            </div>
            <div class="col-md-6">
                <h5 class="text-center mb-4 bg-info text-white">Danh sách các thể loại</h5>
                <div class="card-body report-table">
                    <div class="table-responsive transactions-table">
                        <table class="table table-bordernone m-0" id="room">
                            <thead>
                                <tr>
                                    <th class="light-font">#</th>
                                    <th class="light-font">Tên phòng</th>
                                    <th class="light-font">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $categoryNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="col-1"><?php echo e($key+1); ?></td>
                                        <td class="col-7"><?php echo e($item->name); ?></td>
                                        <td class="col-4">
                                            <div class="d-flex justify-content-around ">
                                                 <a href="<?php echo e(route('categorynew.edit', $item->id)); ?>" 
                                                        class="btn btn-warning col-6 btn-table">Sửa</a>

                                                <a href="<?php echo e(route('categorynew.delete', $item->id)); ?>"
                                                    class="btn btn-danger col-6 btn-table">Xóa</a>
                                                
                                            </div>
                                            
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('js'); ?>
    <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <script>
           
            makeToast("<?php echo e($message); ?>","red")
        </script>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <script>
        
        makeToast("<?php echo e($message); ?>","red")
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
        
        makeToast("<?php echo e($message); ?>","red")
    </script>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\tai_lieu_hoc_tap\nhap_mon_cnpm\Web_QL_PhongTro_L10\resources\views/dashboard/categorynews/index.blade.php ENDPATH**/ ?>