
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
                        <h3>Quản lý tài khoản
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
                        <h5>Danh sách các tài khoản</h5>
                    </div>
                    <div class="card-body report-table">
                        <div class="table-responsive transactions-table">
                            <table class="table table-bordernone m-0" id="room">
                                <thead>
                                    <tr>
                                       
                                        <th class="light-font">Tên tài khoản</th>
                                        <th class="light-font">Email</th>
                                        <th class="light-font">Số điện thoại</th>
                                        <th class="light-font">Ngày tạo</th>
                                        <th class="light-font">Trạng thái</th>
                                        <th class="light-font">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                              
                                    <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                           
                                            <td>
                                                <div class="media">
                                                    <img src="<?php echo e(asset('images/user_avatar/' . $item->profile_photo_path)); ?>"
                                                        class="img-fluid img-80" alt="">
                                                    <div class="media-body">
                                                        <a href="<?php echo e(route('user.show', $item->id)); ?>"><h6><?php echo e($item->name); ?></h6></a>
                                                        <span class="light-font"><?php echo e($item->role == 1 ? "Admin" : (count($item->rooms) > 0 ? "Chủ trọ" : "Người dùng")); ?></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?php echo e($item->email); ?></td>
                                            <td><?php echo e($item->PhoneNumber); ?></td>
                                            <td><?php echo e(date('d-m-Y', strtotime($item->created_at))); ?></td>
                                            <?php if($item->status == 1): ?>
                                                <td><span class="label label-light color-3">Hoạt động</span></td>
                                            <?php elseif($item->status == 0): ?>
                                                <td><span class="label label-light color-2">Chặn</span></td>
                                            <?php else: ?>
                                                <td><span class="label label-dark label-pill">Lỗi</span></td>
                                            <?php endif; ?>
                                            <td>
                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                                  <ul class="dropdown-menu p-1 " aria-labelledby="dropdownMenuButton1">
                                                   <ul class="d-flex flex-column ">
                                                    <li class=" btn btn-warning  mt-1"><a  a class="text-light" href="<?php echo e(route('account.edit', $item->id)); ?>">Sửa</a></li>
                                                    <li class=" btn btn-danger mt-1"><a class="text-light"  href="<?php echo e(route('account.block', $item->id)); ?>"><?php echo e($item->status == 1 ? "Chặn" : "Bỏ chặn"); ?></a></li>
                                                    <li class=" btn btn-info mt-1"><a a class="text-light" href="<?php echo e(route('account.sendNotification',$item->id)); ?>">Gửi thông báo</a></li>
                                                   </ul>
                                                  </ul>
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

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\phongtro20\resources\views/dashboard/account/index.blade.php ENDPATH**/ ?>