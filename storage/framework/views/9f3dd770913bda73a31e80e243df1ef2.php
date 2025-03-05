
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('style'); ?>
    <style>
        .dropdown-menu {
            overflow: auto;
            max-height: 200px;
        }
    </style>
<?php $__env->stopSection(); ?>

<!-- home section start -->
<section class="layout-map vertical-map">
    <div class="map" id="myMap"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 search-withmap">
                <div class="vertical-search">
                    <div class="left-sidebar">
                        <form class="row gx-2" action="<?php echo e(route('filter_room')); ?>" method="GET">
                            <?php echo csrf_field(); ?>
                            <div class="col-lg-12">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="">Huyện, Thành phố</label>
                                        <div class="dropdown">
                                            <span class="dropdown-toggle font-rubik" data-bs-toggle="dropdown"><span
                                                    id="district">Tất cả</span> <i
                                                    class="fas fa-angle-down"></i></span>
                                            <div class="dropdown-menu text-start" id="districts">
                                                <input type="text" name="district_input" class="d-none"
                                                    value="Tất cả">
                                                <a class="dropdown-item district" code="000" code_name="all"
                                                    href="javascript:void(0)">Tất cả</a>
                                                <?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a class="dropdown-item district" code="<?php echo e($district->code); ?>"
                                                        code_name="<?php echo e($district->code_name); ?>"
                                                        href="javascript:void(0)"><?php echo e($district->full_name); ?></a>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" name="ward_id" id="wards_input" class="d-none" value="Tất cả">
                                    <div class=" col-sm-6">
                                        <label>Xã, Phường</label>
                                        <div class="dropdown">
                                            <span class="dropdown-toggle font-rubik" data-bs-toggle="dropdown"><span
                                                    id="wards">Tất cả</span> <i
                                                    class="fas fa-angle-down"></i></span>
                                            <div class="dropdown-menu text-start " id="ward_list">
                                                <a class="dropdown-item" href="javascript:void(0)">Tất cả</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="col-lg-12">
                                <label>Loại Phòng</label>
                                <div class="dropdown">
                                    <input type="text" name="category_id" id="category_input" class="d-none"
                                        value="Tất cả">
                                    <span class="dropdown-toggle font-rubik" data-bs-toggle="dropdown"><span>Tất
                                            cả</span> <i class="fas fa-angle-down"></i></span>
                                    <div class="dropdown-menu text-start" id="category_list">
                                        <a class="dropdown-item" href="javascript:void(0)">Tất cả</a>
                                        <?php $__currentLoopData = $categoryRoom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <a class="dropdown-item " code="<?php echo e($item->id); ?>"
                                                href="javascript:void(0)"><?php echo e($item->name); ?></a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
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
                                <div class="col-lg-12">
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
                                <div class="form-group col-sm-12">
                                    <label>Tùy chọn</label>
                                    <div class="feature-checkbox">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="chk-ani">
                                                    <input class="checkbox_animated color-2 add_ons" name="add_ons[]"
                                                        value="Nơi để xe" type="checkbox"> Nơi để xe
                                                </label>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="chk-ani1">
                                                    <input class="checkbox_animated color-2 add_ons" name="add_ons[]"
                                                        value="Camera an ninh" type="checkbox"> Camera an ninh
                                                </label>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="chk-ani2">
                                                    <input class="checkbox_animated color-2 add_ons" name="add_ons[]"
                                                        value="Wifi miễn phí" type="checkbox"> Wifi miễn phí
                                                </label>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="chk-ani3">
                                                    <input class="checkbox_animated color-2 add_ons" name="add_ons[]"
                                                        value="Điều hòa" type="checkbox"> Điều hòa
                                                </label>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="chk-ani4">
                                                    <input class="checkbox_animated color-2 add_ons" name="add_ons[]"
                                                        value="Bình nóng lạnh" type="checkbox"> Bình nóng lạnh
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-gradient color-4 mt-2">Tìm kiếm</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- home section end -->

<!-- property section start -->
<section class="property-section">
    <div class="container">
        <div class="row ratio_55">
            <div class="col">
                <div class="title-2">
                    <h2>Phòng trọ mới nhất</h2>
                    <p>Khám phá những phòng trọ mới nhất trong hôm nay</p>
                </div>
                <div class="property-2 row column-space zoom-gallery">
                    <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4 wow fadeInUp ">
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
                                            alt="">Điện : <?php echo e(number_format($item->electric)); ?> đ</li>
                                        <li><img src="../assets/images/svg/icon/bathroom.svg" class="img-fluid"
                                            alt="">Nước : <?php echo e(number_format($item->water)); ?> đ</li>
                                        <li><img src="../assets/images/svg/icon/square-ruler-tool.svg"
                                            class="img-fluid ruler-tool" alt="">Diện tích:
                                            <?php echo e($item->area); ?> m<sup>2</sup></li>
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
            </div>
        </div>
    </div>
</section>
<!-- property section end -->

<!-- property section tab start -->
<section class="property-section bg-comman-2">
    <div class="container">
        <div class="row ratio_55">
            <div class="col">
                <div class="title-2 text-white">
                    <h2>Bạn muốn tìm loại phòng như nào ?</h2>
                    <p>Có nhiều loại phòng khác nhau, bạn có thể tìm loại phòng phù hợp cho bản thân tại đây</p>
                </div>
                <ul id="tabs" class="nav nav-tabs">
                    <?php $__currentLoopData = $categoryRoom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="nav-item "><a href="#" data-bs-target="#category<?php echo e($item->id); ?>"
                                data-bs-toggle="tab"
                                class="nav-link <?php if($key == 1): ?> active <?php endif; ?>"><?php echo e($item->name); ?></a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <div id="tabsContent" class="tab-content" style="z-index: 1;">
                    <?php $__currentLoopData = $categoryRoom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div id="category<?php echo e($category->id); ?>"
                            class="tab-pane <?php if($key == 1): ?> active show <?php endif; ?> fade">
                            <div class="property-2 row column-space zoom-gallery">
                                <?php $__currentLoopData = $category->getRoom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($k == 3): ?>
                                        <?php if($k == 3) break; ?>
                                    <?php endif; ?>
                                    <div class="col-xl-4 col-md-6">
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
                                                </div>
                                            </div>

                                            <div
                                                class="property-details <?php echo e($item->status == 1 ? '' : 'hidden_room'); ?>">
                                                <span
                                                    class="font-roboto"><?php echo e($item->getWard->getDistrict->name); ?></span>
                                                <a href="<?php echo e(route('Room_show', $item->id)); ?>">
                                                    <h3><?php echo e($item->name); ?></h3>
                                                </a>
                                                <h6><?php echo e(number_format($item->price) . '/' . $item->unit); ?></h6>
                                                <p class="font-roboto"><?php echo e(Str::words($item->description, '25')); ?></p>
                                                <ul>
                                                    <li><img src="../assets/images/svg/icon/double-bed.svg" class="img-fluid"
                                                            alt="">Điện : <?php echo e(number_format($item->electric)); ?> đ</li>
                                                    <li><img src="../assets/images/svg/icon/bathroom.svg" class="img-fluid"
                                                            alt="">Nước : <?php echo e(number_format($item->water)); ?> đ</li>
                                                    <li><img src="../assets/images/svg/icon/square-ruler-tool.svg"
                                                            class="img-fluid ruler-tool" alt="">Diện tích:
                                                        <?php echo e($item->area); ?> m<sup>2</sup></li>
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
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- property section tab end -->






<!-- blog section start -->
<section class="blog-section bg-comman-2">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="title-2 text-white">
                    <h2>bài viết nổi bật</h2>
                </div>
                <div class="blog-1">
                    <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div>
                        <div class="blog-box">
                            <div class="img-box">
                                <img src="<?php echo e(asset('images/thumbnail_news/' . $item->thumbnail)); ?>" alt="" class="img-fluid">
                            </div>
                            <div class="blog-content row">
                                <span class="col-6"><?php echo e($item->created_at->diffForHumans($current)); ?></span>
                                <span class="col-6"><?php echo e($item->view); ?> lượt xem</span>
                                <h3>
                                    <a href="blog-detail-left-sidebar.html">
                                        <?php echo e($item->title); ?>

                                    </a>
                                </h3>
                                <p class="font-roboto"><?php echo e(Str::words($item->short_content, '30')); ?></p>
                                <a  href="<?php echo e(route('frontend.news.show', $item->slug)); ?>"
                                    class="btn btn-gradient btn-pill color-2 btn-lg">Đọc tiếp</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- blog section end -->

<!-- brand section start -->
<section class="small-section bg-light brand-wrap">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="title-2">
                    <h2>Các công nghệ sử dụng</h2>
                </div>
                <div class="slide-2 brand-slider">
                    <div>
                        <a href="javascript:void(0)" class="logo-box">
                            <img src="../assets/images/brand/6.png" alt="" class="img-fluid">
                        </a>
                    </div>
                    <div>
                        <a href="javascript:void(0)" class="logo-box">
                            <img src="../assets/images/brand/7.png" alt="" class="img-fluid">
                        </a>
                    </div>
                    <div>
                        <a href="javascript:void(0)" class="logo-box">
                            <img src="../assets/images/brand/8.png" alt="" class="img-fluid">
                        </a>
                    </div>
                    <div>
                        <a href="javascript:void(0)" class="logo-box">
                            <img src="../assets/images/brand/9.png" alt="" class="img-fluid">
                        </a>
                    </div>
                    <div>
                        <a href="javascript:void(0)" class="logo-box">
                            <img src="../assets/images/brand/10.png" alt="" class="img-fluid">
                        </a>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
</section>

<!-- brand section end -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('assets/js/range-slider.js')); ?>"></script>
<!-- Lấy thông tin xã, tỉnh -->
<?php echo $__env->make('js.getward', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script>
    function loadMapScenario() {
        var map = new Microsoft.Maps.Map(document.getElementById('myMap'), {
            center: new Microsoft.Maps.Location(21.004768, 105.843357),
            zoom: 16,
            mapTypeId: Microsoft.Maps.MapTypeId.aerial,

        });

        markersData = [
            <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $latlng = json_decode($room->latlng);
                ?> {
                    name: '<?php echo e($room->name); ?>',
                    location_latitude: <?php echo e($latlng->lat); ?>,
                    location_longitude: <?php echo e($latlng->long); ?>,
                    map_image_url: "<?php echo e(asset('images/main_room/') . '/' . $room->main_img); ?>",
                    name_point: '<?php echo e($room->name); ?>',
                    price: '<?php echo e(number_format($room->price)); ?>đ',
                    label: 'for sale',
                    electric: '<?php echo e(number_format($room->electric)); ?>đ',
                    water: '<?php echo e(number_format($room->water)); ?>đ',
                    sqft: '<?php echo e($room->area); ?>',
                    url_point: '<?php echo e(route('Room_show', $room->id)); ?>'
                },
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        ];
        var pushpins = Microsoft.Maps.TestDataGenerator.getPushpins(markersData.length, map.getBounds(), {
            icon: 'https://www.bingmapsportal.com/Content/images/poi_custom.png'
        });

        var infobox = new Microsoft.Maps.Infobox(pushpins[0].getLocation(), {
            visible: false,
            autoAlignment: true
        });
        console.log(markersData);
        infobox.setMap(map);
        for (var i = 0; i < pushpins.length; i++) {

            //Store some metadata with the pushpin
            var pushpin = [];
            var htmldata = "";
            if (markersData[i]) {
                htmldata = '<div class="infoBox">' +
                    '<div class="marker-detail">' +
                    '<img src="' + markersData[i].map_image_url + '" alt="Image"/>' +
                    '<div class="label label-shadow">' + markersData[i].label + '</div>' +
                    '<div class="detail-part">' +
                    '<h6>' + markersData[i].name_point + '</h6>' +
                    '<ul>' +
                    '<li>Điện : ' + markersData[i].electric + '</li>' +
                    '<li>Nước :' + markersData[i].water + '</li>' +
                    '<li>Diện tích :' + markersData[i].sqft + ' m2</li>' +
                    '</ul>' +
                    '<span>' + markersData[i].price + '</span>' +
                    '<a href="' + markersData[i].url_point + '">Chi tiết</a>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
                var loc = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(markersData[i].location_latitude,
                    markersData[i].location_longitude));
                pushpin = loc;
                pushpin.metadata = {
                    title: "",
                    description: htmldata
                };
                pushpins[i] = loc;
                Microsoft.Maps.Events.addHandler(pushpin, 'click', function(args) {
                    infobox.setOptions({
                        location: args.target.getLocation(),
                        title: args.target.metadata.title,
                        description: args.target.metadata.description,
                        visible: true
                    });
                });
            }
        }
        map.entities.push(pushpins);

    }
</script>

<script
    src='https://www.bing.com/maps/sdk/mapcontrol?key=AhJkSEdXLFcChv2vJNdVpNKbyRg4D9gIJSfhqiO-Zfpn4zTm5Ei9k6h4QoryaLln&amp;callback=loadMapScenario'
    async defer></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\tai_lieu_hoc_tap\nhap_mon_cnpm\Web_QL_PhongTroBK\resources\views/frontend/home.blade.php ENDPATH**/ ?>