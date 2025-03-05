

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- breadcrumb start -->
    <section class="breadcrumb-section p-0">
        <img src="../assets/images/inner-background.jpg" class="bg-img img-fluid" alt="">
        <div class="container">
            <div class="breadcrumb-content">
                <div>
                    <h2>Bài viết</h2>
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('trang_chu')); ?>">Trang chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page">bài viết</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb end -->

    <!-- blog section start-->
    <section class="ratio_landscape blog-list-section">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4">
                    <div class="sticky-cls blog-sidebar">
                        <div class="filter-cards">
                            <div class="advance-card">
                                <form class="search-bar" method="post" action="<?php echo e(route('frontend.news.search')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <input type="text" name="title" placeholder="tìm kiếm bài viết">
                                    <i class="fas fa-search"></i>
                                </form>
                            </div>
                            <div class="advance-card">
                                <h6>Loại bài viết</h6>
                                <div class="category-property">
                                    <ul>
                                        <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $count = 0;
                                                foreach ($item->getNews as $key => $value) {
                                                    if ($value->status == 1) {
                                                        $count++;
                                                    }
                                                }
                                            ?>
                                            <?php if($count != 0): ?>
                                                <li><a href="javascript:void(0)"><i
                                                            class="fas fa-arrow-right me-2"></i><?php echo e($item->name); ?><span
                                                            class="float-end">(<?php echo e($count); ?>)</span></a></li>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="advance-card">
                                <h6>Phòng trọ mới nhất</h6>
                                <div class="recent-property">
                                    <ul>
                                        <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <div class="media">
                                                <img src="<?php echo e(asset('images/main_room/') . '/' . $room->main_img); ?>" class="img-fluid" alt="">
                                                <div class="media-body">
                                                    <a href="<?php echo e(route('Room_show', $room->id)); ?>"><h5><?php echo e($room->name); ?></h5></a>
                                                    <span><?php echo e(number_format($room->price, 0, '', ',')); ?>đ/ <span><?php echo e($room->unit); ?></span></span>
                                                </div>
                                            </div>
                                        </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="blog-list row">
                        <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-12">
                                <div class="blog-wrap wow fadeInUp">
                                    <div class="blog-image">
                                        <div>
                                            <img src="<?php echo e(asset('images/thumbnail_news/' . $item->thumbnail)); ?>"
                                                class="bg-img img-fluid" alt="">
                                        </div>
                                    </div>
                                    <div class="blog-details">
                                        <div>
                                            <span><i data-feather="user"></i> <?php echo e($item->getUser->name); ?></span>
                                            <h3><a href="<?php echo e(route('frontend.news.show', $item->slug)); ?>"><?php echo e($item->title); ?></a></h3>
                                            <p class="font-roboto"><?php echo e(Str::words($item->short_content, '50')); ?>

                                            </p>
                                            <div class="row col-12">
                                                <p class="col-4"><?php echo e($item->view); ?> lượt xem</p>
                                                <p class="col-4"><?php echo e($item->created_at->diffForHumans($current)); ?></p>
                                                <a class="col-4" href="<?php echo e(route('frontend.news.show', $item->slug)); ?>">Xem ngay</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <nav class="theme-pagination">
                            <?php echo e($news->appends(request()->except('page'))->render('frontend.components.pagination')); ?>

                        </nav>
                    </div>
                </div>
            </div>
    </section>
    <!-- blog section end-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\phongtro20\resources\views/frontend/news/index.blade.php ENDPATH**/ ?>