<?php if($paginator->hasPages()): ?>
    <!-- Pagination -->
    <div class="pull-right pagination">
        <ul class="pagination">
            
            <?php if($paginator->onFirstPage()): ?>  
            <?php else: ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo e($paginator->previousPageUrl()); ?>" aria-label="Previous">
                    <span aria-hidden="true">«</span>
                    <span class="sr-only">Trang trước</span>
                </a>
            </li>
            <?php endif; ?>

            
            <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <?php if(is_array($element)): ?>
                    <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($page == $paginator->currentPage()): ?>
                        <li class="page-item active"><a class="page-link" href="javascript:void(0)"><?php echo e($page); ?></a></li>
                        <?php elseif(($page == $paginator->currentPage() - 1||$page == $paginator->currentPage() + 1) || $page == $paginator->lastPage()): ?>
                        <li class="page-item"><a class="page-link" href="<?php echo e($url); ?>"><?php echo e($page); ?></a></li>
                        <?php elseif($page == $paginator->currentPage() + 2 || $page == $paginator->currentPage() -2): ?>
                            <li class="disabled page-item"><a class="page-link" href="javascript:void(0)"><i class="fa fa-ellipsis-h"></i></a></li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            
            <?php if($paginator->hasMorePages()): ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo e($paginator->nextPageUrl()); ?>" aria-label="Next">
                    <span aria-hidden="true">»</span>
                    <span class="sr-only">Trang sau</span>
                </a>
            </li>
            <?php else: ?>
              
            <?php endif; ?>
        </ul>
    </div>
    <!-- Pagination -->
<?php endif; ?>

   
    
<?php /**PATH E:\laragon\www\phongtro20\resources\views/frontend/components/pagination.blade.php ENDPATH**/ ?>