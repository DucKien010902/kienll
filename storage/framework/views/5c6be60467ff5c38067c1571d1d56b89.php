
<?php $__env->startSection('style'); ?>

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
                        <h3>Quản lý loại phòng trọ
                           <small>
                            
                        </small> 
                        </h3>
                    </div>
                </div>
                <div class="col-sm-6">

                    <a href="<?php echo e(route('them_loai_phong')); ?>" class="btn btn-outline-success btn-to-right">Thêm loại phòng</a>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid end -->

    <!-- Container-fluid start -->
    <div class="container-fluid">
        <div class="row agent-section property-section user-lists">
            <div class="col-lg-12">
                <div class="property-grid-3 agent-grids ratio2_3">
                    <div class="property-2 row column-sm property-label property-grid list-view">
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       
                        <?php
                            $diff = time() - strtotime($item->created_at);
                            $day = round($diff / (60 * 60 * 24));
                        ?>
                        <div class="col-md-12 col-xl-6">
                            <div class="property-box">
                                <div class="agent-image">
                                    <div>
                                        <img src="<?php echo e(asset('images/categoryroom/'.$item->image)); ?>" class="bg-img" alt="">
                                        <?php if($day < 1): ?>
                                        <span class="label label-shadow"><?php echo e("Loại phòng mới"); ?></span>
                                        <?php endif; ?>
                                        
                                        <div class="agent-overlay"></div>
                                        <div class="overlay-content">
                                            <ul>
                                                <li><a href="<?php echo e(route('sua_loai_phong', ['id' => $item->id])); ?>"> <i  data-feather="edit"></i></a>
                                                </li>
                                                <li><a href="<?php echo e(route('xoa_loai_phong', ['id' => $item->id])); ?>"><i data-feather="trash"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="agent-content">
                                    <h4><?php echo e($item->name); ?></h4>
                                    <p class=""><?php echo e(Str::words($item->description, '25')); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       
                        
                        
                        
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid end -->
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\tai_lieu_hoc_tap\nhap_mon_cnpm\Web_QL_PhongTroBK\resources\views/dashboard/categoryroom/index.blade.php ENDPATH**/ ?>