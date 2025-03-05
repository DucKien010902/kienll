
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
                        <h3>Quản lý bài viết
                            <small>
                                
                            </small>
                        </h3>
                    </div>
                </div>
                <div class="col-sm-6">

                    <a href="<?php echo e(route('news.add')); ?>" class="btn btn-outline-success btn-to-right">Đăng bài</a>

                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid end -->
    <div class="container-fluid">
        <div class="row agent-section property-section user-lists">
            <div class="col-lg-12">
                <div class="property-grid-3 agent-grids ratio2_3">
                    <div class="property-2 row column-sm property-label property-grid list-view">
                        <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-12 col-xl-6">
                                <div class="property-box">
                                    <div class="agent-image">
                                        <div>
                                            <img src="<?php echo e(asset('images/thumbnail_news/' . $item->thumbnail)); ?>" class="bg-img"
                                                alt="">
                                            <?php if($item->status != 1): ?>
                                                <span class="label label-dark"><?php echo e('Không công khai'); ?></span>
                                            <?php else: ?>
                                                <span class="label label-shadow"><?php echo e('Công khai'); ?></span>
                                            <?php endif; ?>

                                            <div class="agent-overlay"></div>
                                            <div class="overlay-content">
                                                <ul>
                                                    <li><a href="<?php echo e(route('news.edit', ['slug' => $item->slug])); ?>"
                                                            title="Sửa"> <i data-feather="edit"></i></a>
                                                    </li>
                                                    <li><a href="<?php echo e(route('news.delete', ['slug' => $item->slug])); ?>"
                                                            title="Xóa"><i data-feather="trash"></i></a>
                                                    </li>
                                                    <?php if($item->status == 1): ?>
                                                        <li><a href="<?php echo e(route('news.status', ['slug' => $item->slug])); ?>"
                                                                title="Ẩn bài viết"><i data-feather="eye-off"></i></a></li>
                                                    <?php else: ?>
                                                        <li><a href="<?php echo e(route('news.status', ['slug' => $item->slug])); ?>"
                                                                title="Hiển thị bài viết"><i data-feather="eye"></i></a>
                                                        </li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="agent-content">
                                        <h4><?php echo e(Str::words($item->title, '10')); ?></h4>
                                        <p class=""><?php echo e(Str::words($item->short_content, '25')); ?></p>
                                        <div class="row col-12">

                                            <h8 class="col-6"><?php echo e($item->view); ?> Lượt xem</h8>
                                            <h8 class="col-6"><?php echo e($item->created_at->diffForHumans($current)); ?></h8>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\phongtro20\resources\views/dashboard/news/index.blade.php ENDPATH**/ ?>