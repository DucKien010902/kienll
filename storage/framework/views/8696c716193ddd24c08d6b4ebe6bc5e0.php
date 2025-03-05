
<?php $__env->startSection('style'); ?>
    <style>
        .hidden_room {
            background-color: #00000073;
        }
        .customizer-wrap .customizer-contain h6::before {
            transition: all 0.5s;
        }
        .customizer-wrap .customizer-contain h6:hover::before  {
            width: 100px;
            height: 5px;
        }
        .customizer-wrap .customizer-contain h6:hover a {
            color: #f31313;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- breadcrumb start -->
    <section class="breadcrumb-section p-0">
        <img src="../assets/images/inner-background.jpg" class="bg-img img-fluid" alt="">
        <div class="container">
            <div class="breadcrumb-content">
                <div>
                    <h2>Thông tin tài khoản</h2>
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('trang_chu')); ?>">Trang chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Thông tin tài khoản</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb end -->

    <!-- agent profile section start -->
    <section class="agent-section property-section agent-profile-wrap">
        <div class="container">
            <div class="row ratio_55">
                <div class="col-xl-12 col-lg-12 property-grid-2">
                    <div class="our-agent theme-card">
                        <div class="row">
                            <div class="col-sm-6 ratio_landscape">
                                <div class="agent-image">
                                    <img src="<?php echo e(asset('images/user_avatar') . '/' . $user->profile_photo_path); ?>"
                                        class="img-fluid bg-img" alt="">
                                    
                                </div>
                            </div>
                            <?php
                                $address = json_decode($user->address);
                            ?>
                            <div class="col-sm-6">
                                <div class="our-agent-details">
                                    <h3 class="f-w-600"><?php echo e($user->name); ?></h3>
                                    
                                    <ul>
                                        <li>
                                            <div class="media">
                                                <div class="icons-square">
                                                    <i data-feather="map-pin"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h6><?php echo e($address->address); ?></h6>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <div class="icons-square">
                                                    <i data-feather="phone-call"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h6><?php echo e($user->PhoneNumber); ?></h6>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <div class="icons-square">
                                                    <i data-feather="mail"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h6><?php echo e($user->email); ?></h6>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="with-link">
                                            <div class="media">
                                                <div class="icons-square">
                                                    <i data-feather="link"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h6><a
                                                            href="<?php echo e('https://zalo.me/' . $user->Zalo); ?>"><?php echo e('https://zalo.me/' . $user->Zalo); ?></a>
                                                    </h6>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <div class="icons-square">
                                                    <i class="fab fa-facebook-f"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h6><a href="<?php echo e($user->Facebook); ?>"><?php echo e($user->Facebook); ?></a></h6>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                  

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="about-agent theme-card">
                        <h3>Mô tả</h3>
                        <div class="row">
                            <div class="col-sm-12">
                                <p class="font-roboto"><?php echo $user->description; ?></p>
                            </div>

                        </div>
                    </div>
                    <div class="agent-property">
                        <div class="filter-panel">
                            <div class="top-panel">
                                <div>
                                    <h3>Danh sách phòng của bạn</h3>
                                    <?php echo e($Room->links()); ?>

                                </div>

                            </div>
                        </div>
                        <div class="property-2 row column-sm zoom-gallery property-label property-grid">
                            <?php $__currentLoopData = $Room; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-6 wow fadeInUp ">
                                    <div class="property-box ">
                                        <div class="property-image">
                                            <div class="property-slider">
                                                <a href="javascript:void(0)">
                                                    <img src="<?php echo e(asset('images/main_room') . '/' . $item->main_img); ?>"
                                                        class="bg-img" alt="">
                                                </a>
                                                <?php
                                                    $listImg = json_decode($item->list_img);
                                                ?>
                                                <?php if($listImg != null): ?>
                                                <?php $__currentLoopData = $listImg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a href="<?php echo e(route('Room_show', $item->id)); ?>">
                                                        <img src="<?php echo e(asset('images/multi_room') . '/' . $image); ?>"
                                                            class="bg-img" alt="">
                                                    </a>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                 <?php endif; ?>
                                            </div>
                                            <div class="labels-left">
                                                <div>
                                                    <span class="label label-shadow" id="<?php echo e($item->id); ?>"
                                                        class="status"><?php echo e($item->status == 1 ? 'Công khai' : 'Ẩn'); ?></span>
                                                </div>
                                            </div>
                                            <?php if($authUser->id == $user->id): ?>
                                                <a href="<?php echo e(route('change_status_room', $item->id)); ?>" class="seen-data">
                                                    <i data-feather="<?php echo e($item->status == 1 ? 'eye-off' : 'eye'); ?>"></i>
                                                    <span><?php echo e($item->status == 1 ? 'Ẩn' : 'Hiển thị'); ?></span>
                                                </a>
                                            <?php endif; ?>
                                        </div>

                                        <div class="property-details <?php echo e($item->status == 1 ? '' : 'hidden_room'); ?>">
                                            <span class="font-roboto"><?php echo e($item->getWard->getDistrict->name); ?></span>
                                            <a href="<?php echo e(route('Room.show', $item->id)); ?>">
                                                <h3><?php echo e($item->name); ?></h3>
                                            </a>
                                            <h6><?php echo e(number_format($item->price) . '/' . $item->unit); ?></h6>
                                            <p class="font-roboto"><?php echo e(Str::words($item->description, '25')); ?></p>
                                            <ul>
                                                <li><img src="../assets/images/svg/icon/double-bed.svg" class="img-fluid"
                                                        alt="">Điện : <?php echo e(number_format($item->electric)); ?>đ</li>
                                                <li><img src="../assets/images/svg/icon/bathroom.svg" class="img-fluid"
                                                        alt="">Nước : <?php echo e(number_format($item->water)); ?>đ</li>
                                                <li><img src="../assets/images/svg/icon/square-ruler-tool.svg"
                                                        class="img-fluid ruler-tool" alt="">Diện tích:
                                                    <?php echo e($item->area); ?></li>
                                            </ul>

                                            <div class="property-btn d-flex">
                                                <span><?php echo e(date('d-m-Y', strtotime($item->created_at))); ?></span>
                                                <?php if($authUser->id == $user->id): ?>
                                                    <div class="d-flex">
                                                        <a type="button" href="<?php echo e(route('Room_destroy', $item->id)); ?>"
                                                            class="btn btn-dashed btn-pill color-1">Xóa</a>
                                                        <a type="button" href="<?php echo e(route('Room.edit', $item->id)); ?>"
                                                            class="btn btn-dashed btn-pill color-2">Sửa</a>
                                                    </div>
                                                <?php endif; ?>
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
    </section>
    <!-- agent profile section end -->
<?php $__env->stopSection(); ?>
<?php if($authUser->id == $user->id): ?>
<?php $__env->startSection('customiez'); ?>
    <div class="customizer-wrap open">
        <div class="customizer-links">
            <i data-feather="settings"></i>
        </div>
        <div class="customizer-contain custom-scrollbar">
            <div class="setting-back">
                <i data-feather="x"></i>
            </div>
            <div class="layouts-settings">
                <div class="customizer-title">
                    <h6 class="color-2"><a href="<?php echo e(route('user.edit', $user->id)); ?>" >Sửa thông tin</a></h6>
                </div>
            </div>
            <div class="layouts-settings">
                <div class="customizer-title">
                    <h6 class="color-2"><a href="<?php echo e(route('user.change_password')); ?>" >Đổi mật khẩu</a></h6>
                </div>
            </div>
            <div class="layouts-settings">
                <div class="customizer-title">
                    <h6 class="color-2"><a href="<?php echo e(route('booking.index')); ?>">Danh sách đặt phòng</a></h6>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php $__env->startSection('modal'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script
        src='https://www.bing.com/maps/sdk/mapcontrol?key=AhJkSEdXLFcChv2vJNdVpNKbyRg4D9gIJSfhqiO-Zfpn4zTm5Ei9k6h4QoryaLln&amp;callback=loadMapScenario'
        async defer></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\phongtro20\resources\views/frontend/user/index.blade.php ENDPATH**/ ?>