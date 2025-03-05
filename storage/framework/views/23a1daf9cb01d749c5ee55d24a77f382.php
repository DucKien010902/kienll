<div class="page-main-header row">
    <div id="sidebar-toggle" class="toggle-sidebar col-auto">
        <i data-feather="chevrons-left"></i>
    </div>
    <div class="nav-right col p-0">
        <ul class="header-menu">
            
            <li>
                
            </li>
            <li>
                <a href="#!" onclick="javascript:toggleFullScreen()">
                    <i data-feather="maximize"></i>
                </a>
            </li>
            
            <li class="onhover-dropdown <?php echo e(count($notification) > 0 ? 'notification-box': ''); ?>">
                <a href="javascript:void(0)">
                    <i data-feather="bell"></i>
                    <span class="label label-shadow label-pill notification-badge"><?php echo e(count($notification)); ?></span>
                </a>
                <div class="notification-dropdown onhover-show-div">
                    <div class="dropdown-title">
                        <h6>Thông báo</h6>
                       
                    </div>
                    <ul>
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
                </div>
            </li>
           
            <li class="profile-avatar onhover-dropdown">
                <div>
                    <img src="<?php echo e(asset('images/user_avatar/' . Auth::user()->profile_photo_path)); ?>"" class="img-fluid" alt="">
                </div>
                <ul class="profile-dropdown onhover-show-div">
                    <li><a href="<?php echo e(route('profile.index')); ?>"><span>Tài khoản </span><i data-feather="user"></i></a></li>
                    <li><a href="<?php echo e(route('logout')); ?>"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span>Đăng xuất</span><i data-feather="log-in"></i></a></li>
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                    <?php echo csrf_field(); ?>
                </form>
                </ul>
            </li>
        </ul>
    </div>
</div><?php /**PATH D:\tai_lieu_hoc_tap\nhap_mon_cnpm\Web_QL_PhongTro_L10\resources\views/layouts/components/header.blade.php ENDPATH**/ ?>