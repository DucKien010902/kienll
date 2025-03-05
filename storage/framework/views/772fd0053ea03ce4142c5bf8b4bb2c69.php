<ul>
    <?php $__currentLoopData = $childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
       <li>
           <?php echo e($child->name); ?>

           <a href="<?php echo e(route('menus.delete', $child->id)); ?>">X</a>
       <?php if(count($child->childs)): ?>
                <?php echo $__env->make('dashboard.menu.child',['childs' => $child->childs], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
       </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul><?php /**PATH D:\tai_lieu_hoc_tap\nhap_mon_cnpm\Web_QL_PhongTro_L10\resources\views/dashboard/menu/child.blade.php ENDPATH**/ ?>