<ul class="nav-submenu menu-content">
    <?php $__currentLoopData = $childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(count($menu->Childs) == 0): ?>
        <li><a href="<?php echo e(url($menu->location)); ?>"><?php echo e($menu->name); ?></a>
            <?php else: ?>
            <li>
                <a href="#" class="submenu-title"><?php echo e($menu->name); ?></a>
                <?php echo $__env->make('frontend.components.submenus.lv2', ['childs' => $menu->childs], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </li>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<?php /**PATH D:\tai_lieu_hoc_tap\nhap_mon_cnpm\Web_QL_PhongTro_L10\resources\views/frontend/components/submenus/lv1.blade.php ENDPATH**/ ?>