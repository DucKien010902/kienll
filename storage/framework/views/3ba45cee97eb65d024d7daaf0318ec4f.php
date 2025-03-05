<!-- header start -->

<header class="header-4 fixed-header">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="menu">
                    <div class="brand-logo">
                        <a href="<?php echo e(route('trang_chu')); ?>">
                            <img src="<?php echo e(asset('assets/images/logo/13.png')); ?>" style="max-height:100px" alt="" class="img-fluid for-light">
                            
                        </a>
                    </div>
                    <nav>
                        <div class="main-navbar">
                            <div id="mainnav">
                                <div class="toggle-nav">
                                    <i class="fa fa-bars sidebar-bar"></i>
                                </div>
                                <ul class="nav-menu">
                                    <li class="back-btn">
                                        <div class="mobile-back text-end">
                                            <span>Quay lại</span>
                                            <i aria-hidden="true" class="fa fa-angle-right ps-2"></i>
                                        </div>
                                    </li>
                                    <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(count($menu->Childs) == 0): ?>
                                    <li class="">
                                        <a href="<?php echo e(url($menu->location)); ?>" class="nav-link menu-title"><?php echo e($menu->name); ?></a>
                                    </li>
                                    <?php else: ?>
                                    <li class="dropdown">
                                        <a href="#" class="nav-link menu-title"><?php echo e($menu->name); ?></a>
                                        <?php echo $__env->make('frontend.components.submenus.lv1',['childs' => $menu->childs], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </li>
                                         
                                    <?php endif; ?>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 <li class="mobile-log-out ">
                                    <a href="<?php echo e(route('logout')); ?>" class="nav-link menu-title"
                                    onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();"></i>Đăng xuất</a>
                                </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                    <ul class="header-right">
                        <li class="right-menu color-1">
                            <ul class="header-right">
                                <li class="right-menu color-1">
                                    <ul class="nav-menu">
                                        <li>
                                            <form class="search-box" action="<?php echo e(route('filter_room')); ?>" method="GET">
                                                <?php echo csrf_field(); ?>
                                                <i class="fas fa-search search-icon"></i>
                                                <span class="font-roboto">Tìm </span>
                                                <div class="form-group">
                                                    <input type="text" name="name" class="form-control" placeholder="Tìm kiếm">
                                                </div>
                                            </form>
                                        </li>
                                        <?php if(Auth::user() != null): ?>
                       
                        
                        <li>
                            <a href="<?php echo e(route('room_create')); ?>">Đăng Phòng</i></a>
                        </li>
                        
                        <li class="dropdown cart">
                            <a href="javascript:void(0)">
                                <i data-feather="bell"></i>
                                <span><?php echo e(count($notification)); ?></span>
                            </a>
                            
                            <ul class="nav-submenu">
                                <li><h5>Thông báo</h5></li>
                                <?php $__currentLoopData = $notification; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li style="margin-left: 0px">
                                    <div class="media">
                                        <div class="media-body">
                                            <a href="<?php echo e(route('notification.show', $item->id)); ?>"><h5><?php echo e($item->title); ?></h5></a>   
                                            <span><?php echo e($item->updated_at->diffForHumans($current)); ?></span>
                                        </div>
                                    </div>
                                    
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo e(route('user.index')); ?>"><i data-feather="user"></i></a>
                        </li>
                        <li class="desktop-log-out">
                            <a href="<?php echo e(route('logout')); ?>"
                            onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();"><i data-feather="log-out"></i></a>
                        </li>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                            <?php echo csrf_field(); ?>
                        </form>
                        <?php endif; ?>
                      
                        <?php if(Auth::user() == null): ?>
                        <li>
                            <a href="<?php echo e(route('login')); ?>"><strong>Đăng nhập</strong></a>
                        </li>
                        <?php endif; ?>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    
                </div>
            </div>
        </div>
    </div>
</header>
<!--  header end --><?php /**PATH E:\laragon\www\phongtro20\resources\views/frontend/components/header.blade.php ENDPATH**/ ?>