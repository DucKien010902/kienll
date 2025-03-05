
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
                                                    <!-- <i data-feather="link"></i> -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 50 50">
                                                    <path d="M 9 4 C 6.2504839 4 4 6.2504839 4 9 L 4 41 C 4 43.749516 6.2504839 46 9 46 L 41 46 C 43.749516 46 46 43.749516 46 41 L 46 9 C 46 6.2504839 43.749516 4 41 4 L 9 4 z M 9 6 L 15.580078 6 C 12.00899 9.7156859 10 14.518083 10 19.5 C 10 24.66 12.110156 29.599844 15.910156 33.339844 C 16.030156 33.549844 16.129922 34.579531 15.669922 35.769531 C 15.379922 36.519531 14.799687 37.499141 13.679688 37.869141 C 13.249688 38.009141 12.97 38.430859 13 38.880859 C 13.03 39.330859 13.360781 39.710781 13.800781 39.800781 C 16.670781 40.370781 18.529297 39.510078 20.029297 38.830078 C 21.379297 38.210078 22.270625 37.789609 23.640625 38.349609 C 26.440625 39.439609 29.42 40 32.5 40 C 36.593685 40 40.531459 39.000731 44 37.113281 L 44 41 C 44 42.668484 42.668484 44 41 44 L 9 44 C 7.3315161 44 6 42.668484 6 41 L 6 9 C 6 7.3315161 7.3315161 6 9 6 z M 33 15 C 33.55 15 34 15.45 34 16 L 34 25 C 34 25.55 33.55 26 33 26 C 32.45 26 32 25.55 32 25 L 32 16 C 32 15.45 32.45 15 33 15 z M 18 16 L 23 16 C 23.36 16 23.700859 16.199531 23.880859 16.519531 C 24.050859 16.829531 24.039609 17.219297 23.849609 17.529297 L 19.800781 24 L 23 24 C 23.55 24 24 24.45 24 25 C 24 25.55 23.55 26 23 26 L 18 26 C 17.64 26 17.299141 25.800469 17.119141 25.480469 C 16.949141 25.170469 16.960391 24.780703 17.150391 24.470703 L 21.199219 18 L 18 18 C 17.45 18 17 17.55 17 17 C 17 16.45 17.45 16 18 16 z M 27.5 19 C 28.11 19 28.679453 19.169219 29.189453 19.449219 C 29.369453 19.189219 29.65 19 30 19 C 30.55 19 31 19.45 31 20 L 31 25 C 31 25.55 30.55 26 30 26 C 29.65 26 29.369453 25.810781 29.189453 25.550781 C 28.679453 25.830781 28.11 26 27.5 26 C 25.57 26 24 24.43 24 22.5 C 24 20.57 25.57 19 27.5 19 z M 38.5 19 C 40.43 19 42 20.57 42 22.5 C 42 24.43 40.43 26 38.5 26 C 36.57 26 35 24.43 35 22.5 C 35 20.57 36.57 19 38.5 19 z M 27.5 21 C 27.39625 21 27.29502 21.011309 27.197266 21.03125 C 27.001758 21.071133 26.819727 21.148164 26.660156 21.255859 C 26.500586 21.363555 26.363555 21.500586 26.255859 21.660156 C 26.148164 21.819727 26.071133 22.001758 26.03125 22.197266 C 26.011309 22.29502 26 22.39625 26 22.5 C 26 22.60375 26.011309 22.70498 26.03125 22.802734 C 26.051191 22.900488 26.079297 22.994219 26.117188 23.083984 C 26.155078 23.17375 26.202012 23.260059 26.255859 23.339844 C 26.309707 23.419629 26.371641 23.492734 26.439453 23.560547 C 26.507266 23.628359 26.580371 23.690293 26.660156 23.744141 C 26.819727 23.851836 27.001758 23.928867 27.197266 23.96875 C 27.29502 23.988691 27.39625 24 27.5 24 C 27.60375 24 27.70498 23.988691 27.802734 23.96875 C 28.487012 23.82916 29 23.22625 29 22.5 C 29 21.67 28.33 21 27.5 21 z M 38.5 21 C 38.39625 21 38.29502 21.011309 38.197266 21.03125 C 38.099512 21.051191 38.005781 21.079297 37.916016 21.117188 C 37.82625 21.155078 37.739941 21.202012 37.660156 21.255859 C 37.580371 21.309707 37.507266 21.371641 37.439453 21.439453 C 37.303828 21.575078 37.192969 21.736484 37.117188 21.916016 C 37.079297 22.005781 37.051191 22.099512 37.03125 22.197266 C 37.011309 22.29502 37 22.39625 37 22.5 C 37 22.60375 37.011309 22.70498 37.03125 22.802734 C 37.051191 22.900488 37.079297 22.994219 37.117188 23.083984 C 37.155078 23.17375 37.202012 23.260059 37.255859 23.339844 C 37.309707 23.419629 37.371641 23.492734 37.439453 23.560547 C 37.507266 23.628359 37.580371 23.690293 37.660156 23.744141 C 37.739941 23.797988 37.82625 23.844922 37.916016 23.882812 C 38.005781 23.920703 38.099512 23.948809 38.197266 23.96875 C 38.29502 23.988691 38.39625 24 38.5 24 C 38.60375 24 38.70498 23.988691 38.802734 23.96875 C 39.487012 23.82916 40 23.22625 40 22.5 C 40 21.67 39.33 21 38.5 21 z"></path>
                                                    </svg>
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
                                        <li>
                                        <div class="media">
                                                <div class="icons-square">
                                                    <i data-feather="user"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h6><?php echo e($user->role == 1 ? 'Admin' : "Người dùng"); ?></h6>
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
                                                        alt="">Điện : <?php echo e(number_format($item->electric)); ?> đ</li>
                                                <li><img src="../assets/images/svg/icon/bathroom.svg" class="img-fluid"
                                                        alt="">Nước : <?php echo e(number_format($item->water)); ?> đ</li>
                                                <li><img src="../assets/images/svg/icon/square-ruler-tool.svg"
                                                        class="img-fluid ruler-tool" alt="">Diện tích:
                                                    <?php echo e($item->area); ?> m<sup>2</sup></li>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\tai_lieu_hoc_tap\nhap_mon_cnpm\Web_QL_PhongTro_L10\resources\views/frontend/user/index.blade.php ENDPATH**/ ?>