

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
 <!-- agent grid section start -->
 <section class="agent-section property-section">
    <div class="container">
        <div class="row ratio2_3">
            <div class="col-xl-12 col-lg-12 property-grid-3 agent-grids">
                <div class="filter-panel">
                    <div class="top-panel">
                        <div>
                            <h2>Danh sách đặt phòng</h2>
                        </div>
                        
                    </div>

                </div>
                <div class="property-wrapper-grid list-view">
                   
                    <div class="property-2 row column-sm property-label property-grid list-view">
                        <?php $__currentLoopData = $BookingList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       
                        <div class="col-md-12 col-xl-6 wow fadeInUp">
                            <div class="property-box">
                               
                                <div class="agent-content">
                                    <h3><?php echo e($item->name); ?></h3>
                                    <ul class="agent-contact">
                                        <li>
                                            <i class="fas fa-phone-alt"></i> 
                                            <span class="phone-number"><?php echo e($item->phone); ?></span>
                                            <span class="character">*********</span>
                                            <span class="label label-light label-flat color-2">
                                                hiện    
                                                <span>ẩn</span>
                                            </span>
                                        </li>
                                        <li><i class="fas fa-envelope"></i><?php echo e($item->email); ?></li>
                                        <li> </li>
                                       <li>
                                        <span>Nội dung tin nhắn:</span>
                                        <p><?php echo e($item->message); ?></p>
                                       </li>
                                       <li>
                                        <?php echo e($item->updated_at->diffForHumans($current)); ?>

                                       </li>
                                    </ul>
                                    <a href="<?php echo e(route('Room.show', $item->getRoom->id)); ?>">Xem thông tin phòng<i class="fas fa-arrow-right"></i></a>
                                </div>
                                <div class="agent-image ">
                                    <div>
                                        <img src="<?php echo e(asset('images/main_room') . '/' .  $item->getRoom->main_img); ?>" class="bg-img" alt="">
                                        
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
<!-- agent grid section end -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\phongtro20\resources\views/frontend/booking/index.blade.php ENDPATH**/ ?>