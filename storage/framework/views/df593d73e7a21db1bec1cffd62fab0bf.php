
<?php $__env->startSection('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/css/treemenu.css')); ?>">
<style>
.btn-to-right {
    float: right;
}
.tree>li a {
   padding: 2px 6px;
    color: white;
    background: red;
    border-radius: 5px;
    margin-left: 10px;
}
.tree , .tree>li>ul {
    display: flex;
    flex-direction: column;
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
                        <h3>Menu động
                           <small>
                            
                        </small> 
                        </h3>
                    </div>
                </div>
                <div class="col-sm-6">
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid end -->
    <div class="card-body">
        <div class="row">
           <div class="col-md-6">
              <h5 class="mb-4 text-center bg-success text-white ">Thêm menu mới</h5>
              <form accept="<?php echo e(route('menus.store')); ?>" method="post">
                 <?php echo csrf_field(); ?>
                  <?php if(count($errors) > 0): ?>
                           <div class="alert alert-danger  alert-dismissible">
                               <button type="button" class="close" data-dismiss="alert">×</button>
                               <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <?php echo e($error); ?><br>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           </div>
                       <?php endif; ?>
                   <?php if($message = Session::get('success')): ?>
                    <div class="alert alert-success  alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">×</button>   
                            <strong><?php echo e($message); ?></strong>
                    </div>
                 <?php endif; ?>
                 <div class="row">
                    <div class="col-md-12">
                       <div class="form-group">
                          <label>Tiêu đề</label>
                          <input type="text" name="name" class="form-control">   
                       </div>
                    </div>
                 </div>
                 <div class="row">
                    <div class="col-md-12">
                       <div class="form-group">
                          <label>Địa chỉ</label>
                          <input type="text" name="location" class="form-control">   
                       </div>
                    </div>
                 </div>
                 <div class="row">
                    <div class="col-md-12">
                       <div class="form-group">
                          <label>Parent</label>
                          <select class="form-control" name="parent_id">
                             <option selected disabled>Danh sách menu</option>
                             <?php $__currentLoopData = $allMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                       </div>
                    </div>
                 </div>
                 <div class="row">
                    <div class="col-md-12">
                       <button class="btn btn-success">Lưu</button>
                    </div>
                 </div>
              </form>
           </div>
           <div class="col-md-6">
              <h5 class="text-center mb-4 bg-info text-white">Menu List</h5>
               <ul id="tree1">
                  <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <li>
                         <?php echo e($menu->name); ?>

                        <a href="<?php echo e(route('menus.delete', $menu->id)); ?>">X</a>
                         <?php if(count($menu->childs)): ?>
                             <?php echo $__env->make('dashboard.menu.child',['childs' => $menu->childs], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                         <?php endif; ?>
                     </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 </ul>
           </div>
        </div>
     </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('assets/js/treeview.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\tai_lieu_hoc_tap\nhap_mon_cnpm\Web_QL_PhongTroBK\resources\views/dashboard/menu/index.blade.php ENDPATH**/ ?>