

<?php $__env->startSection('style'); ?>
<style>
    .dropdown-menu {
        overflow: auto;
        max-height: 200px;
    }
</style>
<?php
    $oldData = session()->get('filters');
    
    $sort = session()->get('sort');
    $sortTitle = '';
    if($sort['sapXep'] == 'created_at') {
        $sortTitle = "Mới nhất trước";
    }else if($sort['sapXep'] == 'price' && $sort['sortBy'] == 'asc') {  $sortTitle = "Giá thấp nhất trước";
    }else if($sort['sapXep'] == 'price' && $sort['sortBy'] == 'desc') {  $sortTitle = "Giá đắt nhất trước";
    }else if($sort['sapXep'] == 'area' && $sort['sortBy'] == 'desc') {  $sortTitle = "Rộng nhất trước";
    }else if($sort['sapXep'] == 'area' && $sort['sortBy'] == 'asc') {  $sortTitle = "Hẹp nhất trước";}
?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="property-section">
        <div class="container">
            <div class="row ratio_63">
                <div class="col-xl-3 col-lg-4">
                    <div class="left-sidebar">
                        <div class="filter-cards">
                            <div class="advance-card">
                                <div class="back-btn d-lg-none d-block">
                                    Quay lại
                                </div>
                                <h5 class="mb-0 advance-title">Tìm kiếm nâng cao</h5>
                            </div>
                            <form class="advance-card" action="<?php echo e(route('filter_room')); ?>" method="GET">
                                <?php echo csrf_field(); ?>
                                <h6>Lọc</h6>
                                <div class="row gx-2">
                                    <div class="col-12 mt-3">
                                        <label for="amount">Tên phòng trọ : </label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name"  placeholder="Tên phòng" value="<?php echo e(isset($oldData->name) ? $oldData->name : ""); ?>">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                    </div>
                                    <div class="col-12">
                                        <label for="">Huyện, Thành phố</label>
                                        <div class="dropdown">
                                            
                                            <span class="dropdown-toggle font-rubik" data-bs-toggle="dropdown"><span
                                                    id="district"><?php echo e(isset($oldData->district_input) ? $oldData->district_input: "Tất cả"); ?></span> <i class="fas fa-angle-down"></i></span>
                                            <div class="dropdown-menu text-start" id="districts">
                                                <input type="text" name="district_input" class="d-none" value="<?php echo e(isset($oldData->district_input) ? $oldData->district_input: "Tất cả"); ?>">
                                                <a class="dropdown-item district"  code_name="all"
                                                    href="javascript:void(0)" code ="Tất cả">Tất cả</a>
                                                <?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a class="dropdown-item district" code="<?php echo e($district->code); ?>"
                                                        code_name="<?php echo e($district->code_name); ?>"
                                                        href="javascript:void(0)"><?php echo e($district->full_name); ?></a>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <input type="text" name="ward_id" id="wards_input" class="d-none" value="<?php echo e(isset($oldData->old_wards->code) ? $oldData->old_wards->code: "Tất cả"); ?>">
                                        <label>Xã, Phường</label>
                                        <div class="dropdown">
                                            <span class="dropdown-toggle font-rubik" data-bs-toggle="dropdown"><span
                                                    id="wards"><?php echo e(isset($oldData->old_wards->code) ? $oldData->old_wards->name: "Tất cả"); ?></span> <i class="fas fa-angle-down"></i></span>
                                            <div class="dropdown-menu text-start " id="ward_list">
                                                <a class="dropdown-item"  href="javascript:void(0)">Tất cả</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label>Loại Phòng</label>
                                        <div class="dropdown">
                                            <input type="text" name="category_id" id="category_input" value="<?php echo e(isset($oldData->old_category) ? $oldData->category_id : "Tất cả"); ?>" class="d-none"
                                                value="Tất cả">
                                            <span class="dropdown-toggle font-rubik" data-bs-toggle="dropdown"><span><?php echo e(isset($oldData->old_category)? $oldData->old_category : "Tất cả"); ?></span> <i class="fas fa-angle-down"></i></span>
                                            <div class="dropdown-menu text-start" id="category_list">
                                                <a class="dropdown-item" code ="Tất cả" href="javascript:void(0)">Tất cả</a>
                                                <?php $__currentLoopData = $categoryRoom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a class="dropdown-item " code="<?php echo e($item->id); ?>"
                                                        href="javascript:void(0)"><?php echo e($item->name); ?></a>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="col-12">
                                        <div class="price-range">
                                            <div class="row">
                                                <div class="col-4">
                                                    <label for="amount">Giá cả : </label>
                                                </div>
                                                <div class="col-8">
                                                    <input type="text" name="price[]" id="price_from" class="d-none"
                                                        readonly="">
                                                    <input type="text" name="price[]" id="price_to" class="d-none"
                                                        readonly="">
                                                    <div type="text" id="amount" readonly="">
                                                    </div>


                                                </div>

                                                <div id="slider-range"
                                                    class="theme-range-4 ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content">
                                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div><span
                                                        tabindex="0"
                                                        class="ui-slider-handle ui-corner-all ui-state-default"></span><span
                                                        tabindex="0"
                                                        class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="price-range">
                                                <label for="amount">Diện tích : </label>
                                                <input type="text" name="area[]" id="area_from" class="d-none"
                                                    readonly="">
                                                <input type="text" name="area[]" id="area_to" class="d-none"
                                                    readonly="">
                                                <input type="text" id="amount1" readonly="">
                                                <div id="slider-range1"
                                                    class="theme-range-4 ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content">
                                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div><span
                                                        tabindex="0"
                                                        class="ui-slider-handle ui-corner-all ui-state-default"></span><span
                                                        tabindex="0"
                                                        class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="col-12">
                                            <button type="submit"
                                                class="btn btn-gradient color-2 btn-block btn-pill mt-2">Tìm kiếm </button>
                                        </div>
                                    </div>
                                    
                                </form>
                                <div class="advance-card">
                                    <h6>Loại phòng</h6>
                                    <div class="category-property">
                                        <ul>
                                            <?php $__currentLoopData = $categoryCount; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($item != 0): ?>
                                            <li><a href="javascript:void(0)"><i
                                                class="fas fa-arrow-right me-2"></i><?php echo e($key); ?> <span
                                                class="float-end">(<?php echo e($item); ?>)</span></a></li>
                                            <?php endif; ?>
                                           
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="advance-card">
                                    <h6>Hỗ trợ</h6>
                                    <div class="category-property">
                                        <ul>
                                           
                                            <li>
                                                <i data-feather="phone-call" class="me-2"></i>0123 456 789
                                            </li>
                                            <li>
                                                <i data-feather="mail" class="me-2"></i>admin@gmail.com
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-8 property-grid-3">
                        <div class="filter-panel">
                            <div class="top-panel">
                                <div>
                                    <h2>Danh sách phòng trọ</h2>
                                    <span class="show-result">Tìm thấy <?php echo e($room->total()); ?> kết quả phù hợp</span>
                                </div>
                              
                                <ul class="grid-list-filter d-flex">
                                    <li>
                                        <div class="dropdown">
                                            <span class="dropdown-toggle font-rubik" data-bs-toggle="dropdown"><span><?php echo e($sortTitle); ?></span> <i class="fas fa-angle-down ms-lg-3 ms-2"></i></span>
                                            <div class="dropdown-menu text-start">
                                                <a class="dropdown-item" href="<?php echo e(route('filter_room', ["sapXep" => "created_at", "sortBy" => 'desc'])); ?>">Mới nhất trước</a>
                                                <a class="dropdown-item" href="<?php echo e(route('filter_room', ["sapXep" => "price", "sortBy" => 'asc'])); ?>">Giá thấp nhất trước</a>
                                                <a class="dropdown-item" href="<?php echo e(route('filter_room',["sapXep" => "price", "sortBy" => 'desc'])); ?>">Giá đắt nhất trước</a>
                                                <a class="dropdown-item" href="<?php echo e(route('filter_room', ["sapXep" => "area", "sortBy" => 'desc'])); ?>">Rộng nhất trước</a>
                                                <a class="dropdown-item" href="<?php echo e(route('filter_room', ["sapXep" => "area", "sortBy" => 'asc'])); ?>">Hẹp nhất trước</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="collection-grid-view">
                                        <ul>
                                            <li><img src="../assets/images/icon/2.png" alt=""
                                                    class="product-2-layout-view"></li>
                                            <li><img src="../assets/images/icon/3.png" alt=""
                                                    class="product-3-layout-view"></li>
                                            <li><img src="../assets/images/icon/4.png" alt=""
                                                    class="product-4-layout-view"></li>
                                        </ul>
                                    </li>
                                    <li class="grid-btn active">
                                        <a href="javascript:void(0)" class="grid-layout-view">
                                            <i data-feather="grid"></i>
                                        </a>
                                    </li>
                                    <li class="list-btn">
                                        <a href="javascript:void(0)" class="list-layout-view">
                                            <i data-feather="list"></i>
                                        </a>
                                    </li>
                                    <li class="d-lg-none d-block">
                                        <div>
                                            <h6 class="mb-0 mobile-filter font-roboto">Tìm kiếm nâng cao<i
                                                    data-feather="align-center" class="float-end"></i></h6>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>
                        <div class="property-wrapper-grid">
                            <div class="property-2 row column-sm zoom-gallery property-label property-grid">
                                <?php $__currentLoopData = $room; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="property-details <?php echo e($item->status == 1 ? '' : 'hidden_room'); ?>">
                                                <span class="font-roboto"><?php echo e($item->getWard->getDistrict->name); ?></span>
                                                <a href="<?php echo e(route('Room_show', $item->id)); ?>">
                                                    <h3><?php echo e($item->name); ?></h3>
                                                </a>
                                                <h6><?php echo e(number_format($item->price) . '/' . $item->unit); ?></h6>
                                                <p class="font-roboto"><?php echo e(Str::words($item->description, '25')); ?></p>
                                                <ul>
                                                    <li><img src="../assets/images/svg/icon/double-bed.svg" class="img-fluid"
                                                            alt="">Điện : <?php echo e(number_format($item->electric)); ?>đ</li>
                                                    <li><img src="../assets/images/svg/icon/bathroom.svg" class="img-fluid"
                                                            alt="">Nước : <?php echo e(number_format($item->water)); ?>đ</li>
                                                    <li><img src="../assets/images/svg/icon/square-ruler-tool.svg"
                                                            class="img-fluid ruler-tool" alt="">Diện tích:
                                                        <?php echo e($item->area); ?>m<sup>2</sup></li>
                                                </ul>

                                                <div class="property-btn d-flex">
                                                    <span><?php echo e($item->created_at->diffForHumans($current)); ?></span>
                                                    <span><?php echo e($item->CategoryRoom->name); ?></span>
                                                    <div class="d-flex">
                                                        <a type="button" href="<?php echo e(route('Room_show', $item->id)); ?>"
                                                            class="btn btn-dashed btn-pill color-2">Chi tiết</a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           
                        </div>
                        <nav class="theme-pagination">
                            <?php echo e($room->appends(request()->except('page'))->render('frontend.components.pagination')); ?>

                            
                        </nav>
                    </div>
                </div>
            </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<?php echo $__env->make('js.getward', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('js.ranger_slider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\tai_lieu_hoc_tap\nhap_mon_cnpm\Web_QL_PhongTroBK\resources\views/frontend/room/list.blade.php ENDPATH**/ ?>