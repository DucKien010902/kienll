

<?php $__env->startSection('style'); ?>
    <style>
        .comment-button {
            padding-left: 10px;
        }

        .comment-button a {
            font-weight: 600;
            text-transform: capitalize;
            padding: 6px 15px 5px;
            border-radius: 8px;
            font-size: 14px;
            position: relative;
            color: red;
        }

        .comment-button a:hover {
            color: white;
            background-color: red
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- blog details section start-->
    <section class="ratio_40">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-lg-8">
                    <div class="blog-single-detail theme-card">
                        <div class="blog-detail-image">
                            <img src="<?php echo e(asset('images/thumbnail_news/' . $news->thumbnail)); ?>" class="bg-img img-fluid"
                                alt="">
                        </div>
                        <div class="blog-title">
                            <ul class="post-detail">
                                <li><?php echo e($news->created_at->format('d-m-Y')); ?></li>
                                <li>Đăng bởi : <?php echo e($news->getUser->name); ?></li>
                                <li><i class="fa fa-eye"></i> <?php echo e($news->view); ?> lượt xem</li>
                            </ul>
                            <h1><?php echo e($news->title); ?></h1>
                        </div>
                        <div class="my-3">
                            <p class="display-4 blockquote">"<?php echo e($news->short_content); ?>"</p>
                        </div>
                        <div class="details-property">
                            <?php echo $news->content; ?>

                        </div>

                        <div class="comment-section">
                            <h4>Bình luận:</h4>
                            <?php $__currentLoopData = $news->getComment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="comment-box">
                                    <div class="media">
                                        <img src="<?php echo e(asset('images/user_avatar') . '/' . $comment->getUser->profile_photo_path); ?>"
                                            class="img-fluid" alt="">
                                        <div class="media-body">
                                            <div class="comment-title">
                                                <div class="comment-user">
                                                    <i class="fa fa-user"></i>
                                                    <h6><?php echo e($comment->getUser->name); ?></h6>
                                                </div>
                                                <div class="comment-date">
                                                    <i class="fas fa-clock"></i>
                                                    <h6><?php echo e($comment->created_at->diffForHumans($current)); ?></h6>
                                                </div>
                                                <?php if(Auth::check()): ?>
                                                    <?php if($comment->getUser->id == Auth::user()->id || $news->author_id == Auth::user()->id): ?>
                                                        <div class="comment-button">
                                                            <a href="<?php echo e(route('news.comment.delete', $comment->id)); ?>" class="">Xóa</a>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                            <div class="comment-detail">
                                                <p class="font-roboto"><?php echo e($comment->content); ?>

                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <div class="leave-comment comment-section">
                            <?php if(Auth::check()): ?>
                                <div class="comment-box">
                                    <div class="media">
                                        <img src="<?php echo e(asset('images/user_avatar') . '/' . Auth::user()->profile_photo_path); ?>"
                                            class="img-fluid" alt="">
                                        <form class="media-body" action="<?php echo e(route('frontend.news.comment', $news->id)); ?>"
                                            method="post">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('put'); ?>
                                            <div class="comment-detail">
                                                <textarea class="form-control" name="content" placeholder="Bình luận"></textarea>
                                            </div>
                                            <div class="text-end mt-5">
                                                <button type="submit"
                                                    class="btn btn-gradient color-2 btn-pill">Gửi</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div>
                                    <p>Bạn cần <a href="<?php echo e(route('login')); ?>">đăng nhập</a> để bình luận</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="sticky-cls blog-sidebar blog-right">
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
                                                <li><a href="<?php echo e(route('frontend.news.filter', $item->id)); ?>"><i
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
                                                    <img src="<?php echo e(asset('images/main_room/') . '/' . $room->main_img); ?>"
                                                        class="img-fluid" alt="">
                                                    <div class="media-body">
                                                        <a href="<?php echo e(route('Room_show', $room->id)); ?>">
                                                            <h5><?php echo e($room->name); ?></h5>
                                                        </a>
                                                        <span><?php echo e(number_format($room->price, 0, '', ',')); ?>đ/
                                                            <span><?php echo e($room->unit); ?></span></span>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="advance-card">
                                <?php if($news->key_words != 'null'): ?>
                                    <h6>Từ khóa cho bài viết</h6>
                                    <div class="tags">
                                        <ul>


                                            <?php $__currentLoopData = json_decode($news->key_words); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>
                                                    <a href="javascript:void(0)"><?php echo e($item); ?></a>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </ul>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- blog details section end-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\tai_lieu_hoc_tap\nhap_mon_cnpm\Web_QL_PhongTro_L10\resources\views/frontend/news/show.blade.php ENDPATH**/ ?>