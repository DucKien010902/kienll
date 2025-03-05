

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- single property start -->
    <?php
        if (isset($data->video_link)) {
            if (Str::contains($data->video_link, 'www.youtube.com') && Str::contains($data->video_link, 'https://www.youtube.com/watch?v=')) {
                $data->video_link = str_replace('https://www.youtube.com/watch?v=', 'https://www.youtube.com/embed/', $data->video_link);
            }
        }
        $data->list_img = json_decode($data->list_img);
        $data->latlng = json_decode($data->latlng);
        
    ?>

    <section class="single-property mt-0 pt-0">
        <div class="container">
            <div class="row ratio_55">
                <div class="col-xl-9 col-lg-8">
                    <h2><?php echo e($data->name); ?></h2>
                    <div class="description-section tab-description">
                        <div class="description-details">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="single-gallery mb-4">
                                        <div class="gallery-for">
                                            <div class="bg-size">
                                                <img src="<?php echo e(asset('images/main_room') . '/' . $data->main_img); ?>"
                                                    class="bg-img" alt="">
                                            </div>
                                            <?php if($data->list_img != null): ?>
                                            <?php $__currentLoopData = $data->list_img; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div>
                                                <div class="bg-size">
                                                    <img src="<?php echo e(asset('images/multi_room') . '/' . $item); ?>" class="bg-img"
                                                        alt="">
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                            <?php endif; ?>
                                           


                                        </div>
                                        <div class="gallery-nav">
                                            <div>
                                                <img src="<?php echo e(asset('images/main_room') . '/' . $data->main_img); ?>"
                                                    class="img-fluid" alt="">
                                            </div>
                                            <?php if($data->list_img != null): ?>
                                            <?php $__currentLoopData = $data->list_img; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div>
                                                <div class="bg-size">
                                                    <img src="<?php echo e(asset('images/multi_room') . '/' . $item); ?>" class="bg-img"
                                                        alt="">
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                            <?php endif; ?>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="desc-box">
                                <ul class="nav nav-tabs line-tab" id="top-tab" role="tablist">
                                    <li class="nav-item"><a data-bs-toggle="tab" class="nav-link active"
                                            href="#about">Thông tin</a></li>
                                    <li class="nav-item"><a data-bs-toggle="tab" class="nav-link" href="#feature">tiện ích
                                            bổ sung</a></li>
                                    <?php if(isset($data->video_link)): ?>
                                        <li class="nav-item"><a data-bs-toggle="tab" class="nav-link"
                                                href="#video">video</a>
                                    <?php endif; ?>
                                    </li>

                                    <li class="nav-item"><a data-bs-toggle="tab" class="nav-link" href="#location-map">Bản
                                            đồ</a></li>
                                </ul>
                                <div class=" tab-content" id="top-tabContent">
                                    <div class="tab-pane fade show active about page-section" id="about">

                                        <div class="row">

                                            <div class="col-md-6 col-xl-4">
                                                <ul class="property-list-details">
                                                    <li><span>Loại phòng :</span> <?php echo e($data->CategoryRoom->name); ?></li>
                                                    <li><span>Địa chỉ :</span> <?php echo e($data->detail_address); ?></li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6 col-xl-4">
                                                <ul class="property-list-details">
                                                    <li><span>Giá cả :</span>
                                                        <?php echo e(number_format($data->price, 0, '', ',') . 'đ/' . $data->unit); ?>

                                                    </li>
                                                    <li><span>Giá điện :</span>
                                                        <?php echo e(number_format($data->electric, 0, '', ',')); ?>đ/ kW </li>
                                                    <li><span>Nước sinh hoạt :</span>
                                                        <?php echo e(number_format($data->water, 0, '', ',')); ?>đ/ Khối</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6 col-xl-4">
                                                <ul class="property-list-details">

                                                    <li><span>Diện tích phòng :</span><?php echo e($data->area); ?> mét vuông</li>
                                                    <li><span>Số lượng phòng :</span><?php echo e($data->quantity); ?></li>

                                                </ul>
                                            </div>
                                        </div>

                                        <h4 class="mt-4">Mô tả</h4>
                                        <div class="row">
                                            <?php echo $data->describe_room; ?>

                                        </div>
                                    </div>
                                    <div class="tab-pane fade page-section" id="feature">
                                        <h4 class="content-title">Tiện ích</h4>
                                        <div class="single-feature row">
                                            <div class="col-xl-3 col-6">
                                            <ul>
                                                <?php if($data->add_ons): ?>
                                                    <?php $__currentLoopData = json_decode($data->add_ons); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li>
                                                            <i class="fas fa-hands"></i><?php echo e($item); ?>

                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade page-section ratio3_2" id="gallery">
                                        <h4 class="content-title">gallery</h4>
                                    </div>
                                    <?php if(isset($data->video_link)): ?>
                                        <div class="tab-pane fade page-section ratio_40" id="video">
                                            <h4 class="content-title">video</h4>
                                            <div class="play-bg-image">
                                                <div class="bg-size">
                                                    <img src="<?php echo e(asset('images/main_room') . '/' . $data->main_img); ?>"
                                                        class="bg-img" alt="">
                                                </div>
                                                <div class="icon-video">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#videomodal">
                                                        <i class="fas fa-play"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="tab-pane fade page-section" id="location-map">
                                        <h4 class="content-title">Vị trí</h4>
                                        <div class="col-12 layout-map ">
                                            <div class="map" id="myMap"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="desc-box">
                                <div class="page-section">
                                    <h4 class="content-title">Bình luận</h4>
                                    <div class="review">
                                        <?php $__currentLoopData = $data->CommentRoom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       
                                        <div class="review-box">
                                            <div class="media">
                                                <img src="<?php echo e(asset('images/user_avatar') . '/' . $comment->getUser->profile_photo_path); ?>" class="img-70" alt="">
                                                <div class="media-body">
                                                    <h6><?php echo e($comment->getUser->name); ?></h6>
                                                    <p><?php echo e($comment->updated_at->diffForHumans($current)); ?></p>
                                                    <p class="mb-0"><?php echo e($comment->content); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <hr />
                                    <h4 class="content-title">Viết bình luận</h4>
                                    <?php if(Auth::check()): ?>
                                    <form class="review-form" action="<?php echo e(route('commentRoom', ['id' =>$data->id])); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('put'); ?>
                                        <div class="form-group">
                                            <textarea class="form-control" name="content" placeholder="Comment"></textarea>
                                        </div>
                                        <button type="submit"
                                            class="btn btn-gradient color-2 btn-pill">Gửi</button>
                                    </form>
                                    <?php else: ?>
                                    <div>
                                        <p>Bạn cần <a href="<?php echo e(route('login')); ?>">đăng nhập</a> để bình luận</p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="property-section p-t-40">
                        <div class="title-3 text-start inner-title">
                            <h2>Những phòng trọ khác</h2>
                        </div>
                        <div class="row ratio_65">
                            <div class="col-12 property-grid-2">
                                <div class="property-2 row column-sm zoom-gallery property-label property-grid">
                                    <?php $__currentLoopData = $room_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                                        <li><img src="../assets/images/svg/icon/double-bed.svg"
                                                                class="img-fluid" alt="">Điện :
                                                            <?php echo e(number_format($item->electric)); ?> đ</li>
                                                        <li><img src="../assets/images/svg/icon/bathroom.svg"
                                                                class="img-fluid" alt="">Nước :
                                                            <?php echo e(number_format($item->water)); ?> đ</li>
                                                        <li><img src="../assets/images/svg/icon/square-ruler-tool.svg"
                                                                class="img-fluid ruler-tool" alt="">Diện tích:
                                                            <?php echo e($item->area); ?> m<sup>2</sup></li>
                                                    </ul>

                                                    <div class="property-btn d-flex">
                                                        <span><?php echo e(date('d-m-Y', strtotime($item->created_at))); ?></span>
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
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="left-sidebar sticky-cls single-sidebar">
                        <div class="filter-cards">
                            <div class="advance-card">
                                <h6>Thông tin liên hệ</h6>
                                <div class="category-property">
                                    <div class="agent-info">
                                        <div class="media">
                                            <img src="<?php echo e(asset('images/user_avatar') . '/' . $data->User->profile_photo_path); ?>"
                                                class="img-50" alt="">
                                            <div class="media-body ms-2">
                                                <a href="<?php echo e(route('user.show', $data->User->id)); ?>"><h6><?php echo e($data->User->name); ?></h6></a>
                                                <p><?php echo e($data->User->email); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <ul>

                                        <li>
                                            <i data-feather="map-pin"
                                                class="me-2"></i><?php echo e($data->User->address != null ? json_decode($data->User->address)->address : ' '); ?>

                                        </li>
                                        <li>
                                            <i data-feather="phone-call"
                                                class="me-2"></i><?php echo e($data->User->PhoneNumber != null ? $data->User->PhoneNumber : ' '); ?>

                                        </li>
                                        <li>
                                            <a class="me-2"
                                                href="<?php echo e('https://zalo.me/' . $data->User->Zalo); ?>"><?php echo e('Zalo:' . $data->User->Zalo); ?></a>


                                        </li>
                                        <li>
                                            <a class="me-2" href="<?php echo e($data->User->Facebook); ?>">Facebook:
                                                <?php echo e($data->User->name); ?></a>
                                            </i>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="advance-card">
                                <h6>Gửi thông tin liên hệ</h6>
                                <div class="category-property">
                                    <form method="post" action="<?php echo e(route('send_booking', $data->id)); ?>">
                                        <?php echo method_field('PUT'); ?>
                                        <?php echo csrf_field(); ?>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Tên của bạn" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Địa chỉ email">
                                        </div>
                                        <div class="form-group">
                                            <input placeholder="Số điện thoại" class="form-control" name="phone"
                                                id="tbNumbers" oninput="maxLengthCheck(this)" type="tel"
                                                onkeypress="javascript:return isNumber(event)" maxlength="10"
                                                required="">
                                        </div>
                                        <div class="form-group">
                                            <textarea name="message" placeholder="Tin nhắn" class="form-control" rows="3"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-gradient color-2 btn-block btn-pill">Gửi yêu
                                            cầu</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- single property end -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>
    <!-- video modal start -->
    <?php if(isset($data->video_link)): ?>
        <div class="modal fade video-modal" id="videomodal">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <iframe title="realestate" src="<?php echo e($data->video_link); ?>" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- video modal end -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e('assets/js/color/single-property.js'); ?>"></script>
    </script>
    <script
        src='https://www.bing.com/maps/sdk/mapcontrol?key=AgyOfVqVPxgShQQEECEUy5EnGPDHdv1uhGW-RCJbf9EdrKA0YKLDv12JNYflT8gq&amp;callback=loadMapScenario'
        async defer></script>
    <script>
        function loadMapScenario() {
            console.log("chạy");
            var map = new Microsoft.Maps.Map(document.getElementById('myMap'), {
                center: new Microsoft.Maps.Location(<?php echo e($data->latlng->lat); ?>, <?php echo e($data->latlng->long); ?>),
                zoom: 16,
                mapTypeId: Microsoft.Maps.MapTypeId.aerial,

            });
            var icon = new Microsoft.Maps.Pushpin(map.getCenter(), {
                icon: 'https://www.bingmapsportal.com/Content/images/poi_custom.png'
            });
            var location = {
                latitude: '<?php echo e($data->latlng->lat); ?>',
                longitude: '<?php echo e($data->latlng->long); ?>'
            }
            icon.setLocation(location);
            map.entities.push(icon);

        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\tai_lieu_hoc_tap\nhap_mon_cnpm\Web_QL_PhongTroBK\resources\views/frontend/room/show.blade.php ENDPATH**/ ?>