
<?php $__env->startSection('style'); ?>
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" />
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
                        <h3>Quản lý phòng trọ
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
    <div class="container-fluid">
        <div class="row report-summary">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Danh sách phòng trọ</h5>
                    </div>
                    <div class="card-body report-table">
                        <div class="table-responsive transactions-table">
                            <table class="table table-bordernone m-0" id="room">
                                <thead>
                                    <tr>
                                        <th class="light-font">#</th>
                                        <th class="light-font">Tên phòng</th>
                                        <th class="light-font">Số lượng</th>
                                        <th class="light-font">Giá</th>
                                        <th class="light-font">Ngày tạo</th>
                                        <th class="light-font">Trạng thái</th>
                                        <th class="light-font">Địa chỉ</th>
                                        <th class="light-font">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $room; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($key); ?></td>
                                            <td>
                                                <div class="media">
                                                    <img src="<?php echo e(asset('images/main_room/' . $item->main_img)); ?>"
                                                        class="img-fluid img-80" alt="">
                                                    <div class="media-body">
                                                        <h6><?php echo e($item->name); ?></h6>
                                                        <span class="light-font"><?php echo e($item->User->name); ?></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?php echo e($item->quantity); ?></td>
                                            <td><?php echo e(number_format($item->price)); ?>đ</td>
                                            <td><?php echo e(date('d-m-Y', strtotime($item->created_at))); ?></td>
                                            <?php if($item->status == 1): ?>
                                                <td><span class="label label-light color-3">Hoạt động</span></td>
                                            <?php elseif($item->status == 0): ?>
                                                <td><span class="label label-light color-2">Ẩn</span></td>
                                            <?php else: ?>
                                                <td><span class="label label-dark label-pill">Lỗi</span></td>
                                            <?php endif; ?>
                                            <td><?php echo e($item->getWard->name . '/' . $item->getWard->getDistrict->name); ?></td>
                                            <td>
                                                <div class="d-flex flex-column py-3">
                                                    <?php if($item->status != 0): ?>
                                                        <a href="<?php echo e(route('hide_room', $item->id)); ?>"
                                                            class="btn btn-warning mb-2">Ẩn</a>
                                                    <?php endif; ?>
                                                    <a 
                                                        onclick="event.preventDefault();
                                                                 document.getElementById('delete-form-<?php echo e($item->id); ?>').submit();"
                                                        class="btn btn-danger">Xóa</a>
                                                    <form id="delete-form-<?php echo e($item->id); ?>"
                                                        action="<?php echo e(route('ManagerRoom.destroy', $item->id)); ?>"
                                                        method="POST" style="display: none;">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                    </form>
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
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function() {
            $('#room').DataTable();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Lập Trình Web PHP NC\Project_Laravel\Web_QL_PhongTro_L10\resources\views/dashboard/room/index.blade.php ENDPATH**/ ?>