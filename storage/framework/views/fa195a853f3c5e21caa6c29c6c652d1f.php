<div class="page-sidebar">
    <div class="logo-wrap">
        <a href="<?php echo e(route('home')); ?>">
            <img src="<?php echo e(asset('assets/images/logo/15.png')); ?>" class="img-fluid  for-light" alt="">
            
        </a>
        <div class="back-btn d-lg-none d-inline-block">
            <i data-feather="chevrons-left"></i>
        </div>
    </div>
    <div class="main-sidebar">
        <div class="user-profile">
            <div class="media">
                <div class="change-pic">
                    <img src="<?php echo e(asset('images/user_avatar/' . Auth::user()->profile_photo_path)); ?>" class="img-fluid" alt="">
                </div>
                <div class="media-body">
                    <a href="<?php echo e(route('profile.index')); ?>"><h6><?php echo e(Auth::user()->name); ?></h6></a>
                    <span class="font-roboto"><?php echo e(Auth::user()->email); ?></span>
                </div>
            </div>
        </div>
        <div id="mainsidebar">
            <ul class="sidebar-menu custom-scrollbar">
                <li class="sidebar-item">
                    <a href="<?php echo e(route('home')); ?>" class="sidebar-link only-link active">
                        <i data-feather="airplay"></i> 
                        <span>Trang chủ</span>
                        
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="javascript:void(0)" class="sidebar-link ">
                        <i data-feather="home"></i> 
                        <span>Quản Lý Phòng Trọ</span>
                    </a>
                    <ul class="nav-submenu menu-content">
                        <li>
                            <a href="<?php echo e(route('loai_phong')); ?>">
                                <i data-feather="chevrons-right"></i>
                                Quản Lý Loại Phòng
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('ManagerRoom.index')); ?>">
                                <i data-feather="chevrons-right"></i>
                                Quản lý Phòng 
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="javascript:void(0)" class="sidebar-link ">
                        <i data-feather="inbox"></i> 
                        <span>Quản Lý Tin Tức</span>
                    </a>
                    <ul class="nav-submenu menu-content">
                        <li>
                            <a href="<?php echo e(route('categorynew.index')); ?>">
                                <i data-feather="chevrons-right"></i>
                                Thể loại
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('news.index')); ?>">
                                <i data-feather="chevrons-right"></i>
                                Quản lý Bài Viết
                            </a>
                        </li>

                    </ul>
                </li>
                    <li class="sidebar-item">
                        <a href="<?php echo e(route('account.index')); ?>" class="sidebar-link only-link">
                            <i data-feather="users"></i>
                        <span>Quản Lý Tài Khoản</span>
                        </a>
                    </li>
                <li class="sidebar-item">
                    <a href="javascript:void(0)" class="sidebar-link">
                        <i data-feather="settings"></i>
                        <span>Cài đặt website</span>
                    </a>
                    <ul class="nav-submenu menu-content">
                       
                        <li>
                            <a href="<?php echo e(route('menus.index')); ?>">
                                <i data-feather="chevrons-right"></i>
                                Menu Home
                            </a>
                        </li>
                        <li>
                            <a href="add-agent.html">
                                <i data-feather="chevrons-right"></i>
                               Thông tin website
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div><?php /**PATH D:\tai_lieu_hoc_tap\nhap_mon_cnpm\Web_QL_PhongTro_L10\resources\views/layouts/components/sidebar.blade.php ENDPATH**/ ?>