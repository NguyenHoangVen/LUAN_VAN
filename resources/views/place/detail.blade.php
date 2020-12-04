@extends('layouts.index')
@section('content')
<?php $image_topic = json_decode($topic->image) ?>
<div id="content">
    <div class="overview-place" id="forum">
        <div class="post bk-img overlay"
            style="background-image: url('image/image_place/{{json_decode($topic->image)[0]}}')">
            <div class="container ">
                <div class="row">
                    <div class="col-md-12 banner-title text-center">
                        <h1 class="post-title mb-20">{{$topic->name}}</h1>
                        <div class="info-create d-flex justify-content-center ">
                            <a href="" class="avatar"><img src="image/image_avatar/{{$topic->user->avatar}}" alt=""></a>
                            <span class="username align-self-center">{{$topic->user->username}}</span>
                            <span class="create-date align-self-center"><i class="fas fa-calendar-alt">
                                    {{$topic->created_at->format('d-m-Y')}}</i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container content-review">
            <!-- Image topic -->
            <div class="row mb-4 review-image">
                <div class="col-lg-8 col-md-12 bg-white">
                    <div style="padding: 15px">
                        <div class="row">
                            @foreach(json_decode($topic->image) as $image)

                            <div class="col-4 thumb">
                                <img src="image/image_place/{{$image}}" class="img-fluid mb-2" alt="white sample"
                                    data-toggle='modal' data-target='#modalImage'>
                            </div>
                            @endforeach
                            <div class="col-4 thumb">
                                <img src="image/image_avatar/images.jpg" alt="" data-toggle='modal'
                                    data-target='#modalImage'>
                            </div>
                            <div class="col-4 thumb thumb-relative">
                                <img src="image/image_avatar/images.jpg" alt="">
                                <div class="overlayy " data-toggle='modal' data-target='#modalImage'>
                                    <div class="number"><span>+9</span></div>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
                <div class="col-lg-4 col-md-12 sidebar border-left">
                    <div class="location " style="padding: 15px 0px">
                        <h1> Vị Trí</h1>
                        <div class="address">
                            <span><i class="fas fa-map-marker-alt"></i></span>
                            <span>3/2 can tho</span>
                        </div>

                        <div class="map-location map-overlay" data-toggle='modal' data-target='#myModal'>
                            <div id="map-small" style="width: 100%;height: 100%"></div>
                            <div class="alert-view text-center">Toàn màn hình</div>
                        </div>

                        <!-- view lage map modal -->
                        <div class="modal" id="myModal">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title"><i
                                                class="fas fa-map-marker-alt mr-2"></i>{{$topic->address}}</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- map google -->
                                        <div id="map-lag" style="width: 100%;height: 100%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal image review -->
                <div id="modalImage" class="modal">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!--  -->
                            <div class="modal-content">
                                <div class="">
                                    <div class="mainThumbReviewImg">
                                        <img src="image/image_avatar/images.jpg" alt="">
                                    </div>
                                </div>
                                <div class="owl-carousel">
                                    @foreach(json_decode($topic->image) as $image)
                                    <div class="item"> <img src="image/image_place/{{$image}}" alt="image" /> </div>
                                    @endforeach
                                    <div class="item"> <img
                                            src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1557204172/banner_2.jpg"
                                            alt="image" /> </div>
                                    <div class="item"> <img
                                            src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1557204663/park-4174278_640.jpg"
                                            alt="image" /> </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End image topic -->
            <!-- Start post topic -->
            <div class="row ">
                <!-- Tổng hợp các bài viết về topic này -->
                <div class="col-md-12 col-lg-8 post-content">
                    <div class="container">
                        <div class="row topic-name">
                            <div class="col-12">
                                <h1>Lập team, tìm bạn đồng hành trên mọi nẽo đường</h1>
                            </div>
                        </div>
                        <!-- bai viet noi bat -->
                        <div class="row post-feature">
                            <div class="col-12 name p-0">
                                <h1>Topic dính</h1>
                            </div>
                            <div class="col-12 p-0">
                                @if(count($topic->post_review) > 0)
                                <ul class="list-post mb-2">
                                    @foreach($topic->post_review as $post)
                                    <li class="d-flex">
                                        <a href="#" class="avatar d-block mr-3"><img class="img-50"
                                                src="image/image_avatar/{{$post->user->avatar}}" alt=""></a>
                                        <div class="info-desc">
                                            <div class="topic-title">
                                                <span class="topic">[Chia sẻ]</span>
                                                <a href="{{url('topic/post/detail')}}/{{$post->id}}"
                                                    class="title">{{$post->title}}</a>
                                            </div>
                                            <div class="time mt-2"><i class="fas fa-calendar-alt mr-1"></i>
                                                {{$post->created_at->format('d-m-Y')}}</div>
                                        </div>
                                    </li>
                                    @endforeach

                                </ul>
                                @else
                                <div class="alert alert-success">Chưa có bài chia sẻ nào về địa điểm này</div>
                                @endif
                            </div>

                        </div>
                        <!-- Cau hoi moi nhat -->
                        <div class="row post-feature">
                            <div class="col-12 name p-0">
                                <h1>Cau hoi moi nhat</h1>
                            </div>
                            <div class="col-12 p-0">
                                <ul class="list-post mb-2">
                                    <li class="d-flex">
                                        <a href="" class="avatar d-block mr-3"><img class="img-50"
                                                src="https://img3.thuthuatphanmem.vn/uploads/2019/06/08/hinh-nen-hotgirl-duyen-dang_125438813.jpg"
                                                alt=""></a>
                                        <div class="info-desc">
                                            <div class="topic-title">
                                                <span class="topic">[hỏi đáp]</span>
                                                <a href="?page=detail_post_forum" class="title">Mien Nam than thuong</a>
                                            </div>
                                            <div class="time mt-2"><i class="fas fa-calendar-alt mr-1"></i> 10/13/2020
                                            </div>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <a href="" class="avatar d-block mr-3"><img class="img-50"
                                                src="https://img3.thuthuatphanmem.vn/uploads/2019/06/08/hinh-nen-hotgirl-duyen-dang_125438813.jpg"
                                                alt=""></a>
                                        <div class="info-desc">
                                            <div class="topic-title">
                                                <span class="topic">[Chia se]</span>
                                                <a href="?page=detail_post_forum" class="title">LÀO CAI-HÀ GIANG NHỮNG
                                                    NGÀY CHỚM SANG ĐÔNG</a>
                                            </div>
                                            <div class="time mt-2"><i class="fas fa-calendar-alt mr-1"></i> 10/13/2020
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12 p-0">
                                <ul class="list-post mb-2">
                                    <li class="d-flex">
                                        <a href="" class="avatar d-block mr-3"><img class="img-50"
                                                src="https://img3.thuthuatphanmem.vn/uploads/2019/06/08/hinh-nen-hotgirl-duyen-dang_125438813.jpg"
                                                alt=""></a>
                                        <div class="info-desc">
                                            <div class="topic-title">
                                                <span class="topic">[Chia se]</span>
                                                <a href="?page=detail_post_forum" class="title">Mien Nam than thuong</a>
                                            </div>
                                            <div class="time mt-2"><i class="fas fa-calendar-alt mr-1"></i> 10/13/2020
                                            </div>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <a href="" class="avatar d-block mr-3"><img class="img-50"
                                                src="https://img3.thuthuatphanmem.vn/uploads/2019/06/08/hinh-nen-hotgirl-duyen-dang_125438813.jpg"
                                                alt=""></a>
                                        <div class="info-desc">
                                            <div class="topic-title">
                                                <span class="topic">[Chia se]</span>
                                                <a href="?page=detail_post_forum" class="title">LÀO CAI-HÀ GIANG NHỮNG
                                                    NGÀY CHỚM SANG ĐÔNG</a>
                                            </div>
                                            <div class="time mt-2"><i class="fas fa-calendar-alt mr-1"></i> 10/13/2020
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12 p-0">
                                <ul class="list-post mb-2">
                                    <li class="d-flex">
                                        <a href="" class="avatar d-block mr-3"><img class="img-50"
                                                src="https://img3.thuthuatphanmem.vn/uploads/2019/06/08/hinh-nen-hotgirl-duyen-dang_125438813.jpg"
                                                alt=""></a>
                                        <div class="info-desc">
                                            <div class="topic-title">
                                                <span class="topic">[Chia se]</span>
                                                <a href="?page=detail_post_forum" class="title">Mien Nam than thuong</a>
                                            </div>
                                            <div class="time mt-2"><i class="fas fa-calendar-alt mr-1"></i> 10/13/2020
                                            </div>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <a href="" class="avatar d-block mr-3"><img class="img-50"
                                                src="https://img3.thuthuatphanmem.vn/uploads/2019/06/08/hinh-nen-hotgirl-duyen-dang_125438813.jpg"
                                                alt=""></a>
                                        <div class="info-desc">
                                            <div class="topic-title">
                                                <span class="topic">[Chia se]</span>
                                                <a href="?page=detail_post_forum" class="title">LÀO CAI-HÀ GIANG NHỮNG
                                                    NGÀY CHỚM SANG ĐÔNG</a>
                                            </div>
                                            <div class="time mt-2"><i class="fas fa-calendar-alt mr-1"></i> 10/13/2020
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>



                </div>
                <!-- Sidebar (Các topic lân cận, đánh giá topic) -->
                <div class="col-md-12 col-lg-4 sidebar  border-left">

                    <div class="best-nieghtborhood">
                        <div class="title">Tốt nhất lân cận</div>

                        <div class="category">

                            <span class="range-category">
                                <span class="number text-danger">3</span>
                                <span class="category-name text-danger">nha hang</span>
                                <span class="range">Trong phạm vi 10km</span>
                            </span>
                            <ul class="list-place row">


                                <li class="col-lg-12 col-md-6 d-flex">
                                    <a href="" class="d-flex item">
                                        <div class="thumb w-50">
                                            <img class="rounded" src="image/image_avatar/images.jpg" alt="">

                                            <span class="price">54645 đ</span>


                                        </div>
                                        <div class="info w-50 m-1">
                                            <h1 class="title">hotel1</h1>
                                            <div class="star-date d-flex flex-column">
                                                <span class="star">
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                </span>
                                                <span class="date">
                                                    <i class="fas fa-calendar-alt mr-1"></i>
                                                    3/4/2020
                                                </span>
                                                <span class="date">4 Km</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>

                            </ul>
                        </div>


                    </div>
                    <!-- Cac review moi nhat -->
                    <div class="review-new">
                        <div class="title">Review mới nhất</div>
                        <ul class="list-post mb-2">
                            <li class="d-flex">
                                <a href="" class="avatar d-block mr-3"><img
                                        src="https://img3.thuthuatphanmem.vn/uploads/2019/06/08/hinh-nen-hotgirl-duyen-dang_125438813.jpg"
                                        alt=""></a>
                                <div class="info-desc">
                                    <div class="topic-title">
                                        <!-- <span class="topic">[Chia se]</span> -->
                                        <a href="?page=detail_post_forum" class="title">Mien Nam than thuong</a>
                                    </div>
                                    <div class="time mt-2"><i class="fas fa-calendar-alt mr-1"></i> 10/13/2020</div>
                                </div>
                            </li>
                            <li class="d-flex">
                                <a href="" class="avatar d-block mr-3"><img
                                        src="https://img3.thuthuatphanmem.vn/uploads/2019/06/08/hinh-nen-hotgirl-duyen-dang_125438813.jpg"
                                        alt=""></a>
                                <div class="info-desc">
                                    <div class="topic-title">
                                        <!-- <span class="topic">[Chia se]</span> -->
                                        <a href="?page=detail_post_forum" class="title">LÀO CAI-HÀ GIANG NHỮNG NGÀY CHỚM
                                            SANG ĐÔNG</a>
                                    </div>
                                    <div class="time mt-2"><i class="fas fa-calendar-alt mr-1"></i> 10/13/2020</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- Total rating -->
                    <div class="info-rating">
                        <div class="rating-total text-center">
                            <span class="number">{{round($star_avg,2)}} <span class="fa fa-star checked"></span></span>
                        </div>
                        <div class="row" style="padding: 15px">

                            @for($i=5;$i>=1;$i--)
                            <div class="side">
                                <div>{{$i}} ☆</div>
                            </div>
                            <div class="middle">
                                <div class="bar-container">
                                    @if($star_percent == 0)
                                    <div class="bar-5" style="width: 0%"></div>
                                    @else
                                    <div class="bar-5" style="width: {{$star_percent[$i]}}%"></div>
                                    @endif
                                </div>
                            </div>
                            <div class="side right">
                                <div>{{$count_star[$i]}}</div>
                            </div>
                            @endfor



                        </div>
                        <div class="send-rating" data-toggle='modal' data-target='#myRatingPlace'>Gui danh gia</div>
                    </div>
                </div>
            </div>

            <!-- Cac nha hang khach san xung quanh dia diem -->
            
            <div class="row card mt-2 carwl-data">
                <div class="near-location">Các địa điểm lân cận</div>
                <!-- Du lieu Carwl Mytour -->
                @if($data_carwl != false)
                <div class="main-title"><h1>Khách Sạn</h1></div>
                <div class="owl-carousel">
                    @foreach($data_carwl['title_name'] as $key => $value)
                    <div class="item">
                        <a href="https://mytour.vn/<?php echo $data_carwl['links'][$key] ?>" target="_blank">
                            <img src="<?php echo $data_carwl['images'][$key] ?>"
                        alt="" class="img-fluid rounded">
                        </a>
                        <div class="info">
                            <div class="title">
                                <a href="https://mytour.vn/<?php echo $data_carwl['links'][$key] ?>" target="_blank"><?php echo $value ?></a>
                            </div>
                            
                            <div class="num-star">
                                <span class="star">
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                </span>
                            </div>
                            <div class="address">
                                <p>
                                    <i class="fas fa-map-marker-alt text-primary"></i>
                                    <?php echo $data_carwl['address'][$key] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
                <!-- Du lieu tu Tripadvisor -->
                <div class="main-title"><h1>Khách Sạn,Nhà Hàng, Điểm du lịch</h1></div>
                <div class="owl-carousel">
                    @foreach($data_tripadvisor as $item)
                    <div class="item">
                        <div class="category">{{$item->category->localized_name}}</div>
                        <div class="info">
                            <div class="title">
                                <a href="{{$item->web_url}}" target="_blank">{{$item->name}}</a>
                            </div>
                            
                            <div class="num-star">
                                <span class="star">
                                    @if($item->rating == null)
                                    0<i class="fa fa-star checked"></i>
                                    @else
                                    {{$item->rating}}
                                    @for($i=1;$i<= floor($item->rating);$i++)
                                    <i class="fa fa-star checked"></i>
                                    @endfor
                                    @endif
                                </span>
                            </div>
                            <div class="address">
                                <p>
                                    <i class="fas fa-map-marker-alt text-primary"></i>
                                    {{$item->address_obj->address_string}}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <!-- COMMENT, RATING -->
            <div class="row">
                <div class="container rating-comment">
                    <div class="tab-option">
                        <ul class="row  nav nav-tabs bg-white pt-3">
                            <li class="nav-item col-6 bg-ignfo text-center">
                                <a class="nav-link active d-flex flex-column" data-toggle="tab" href="#rating">
                                    <span><i class="fas fa-edit"></i></span>
                                    <span class="number">123</span>
                                    <span class="name">Danh gia</span>
                                </a>
                            </li>
                            <li class="nav-item col-6 bg-ignfo text-center">
                                <a class="nav-link d-flex flex-column" data-toggle="tab" href="#comment">
                                    <span><i class="far fa-comment-alt"></i></span>
                                    <span class="number">123</span>
                                    <span class="name">Binh luan</span>
                                </a>
                            </li>


                        </ul>

                    </div>
                    <div class="tab-content">
                        <!-- RATING -->
                        <div class=" tab-pane active" id="rating">
                            <div class="row d-flex justify-content-between p-3 bg-white">
                                <div class="dropdown col-6 text-cdenter border-bottom pb-1">
                                    <button type="button" class="btn btn-dark dropdown-toggle w-2"
                                        data-toggle="dropdown">Viết đánh giá</button>
                                    <div class="dropdown-menu">
                                        <a href="" class="dropdown-item" data-toggle='modal'
                                            data-target='#myRatingPlace'>Viết đánh giá</a>
                                        <a href="" class="dropdown-item">Đăng ảnh</a>
                                        <a href="" class="dropdown-item " data-toggle='modal'
                                            data-target='#myCommentQuestion'>Viết bình luận</a>
                                    </div>
                                </div>
                                <div class="col-6  border-bottom pb-1">
                                    <h1 class="title text-cdenter">Đánh giá</h1>
                                </div>

                            </div>
                            <div class="info-user-content">
                                @if(count($ratings) > 0)
                                @foreach($ratings as $rating)
                                <div class="row padding">
                                    <div class="col-12">
                                        <div class="info-user d-flex mb-3">
                                            <a href="" class="avatar d-block"><img
                                                    src="image/image_avatar/{{$rating->user->avatar}}" alt=""></a>
                                            <div class="username-time ml-3 d-flex justify-content-between w-100">
                                                <div>
                                                    <a href="" class="username">{{$rating->user->username}}</a>
                                                    <span class="time">đã viết bài viêt này vào
                                                        {{$rating->created_at->format('d-m-Y')}}</span>
                                                </div>
                                                <div class="report-follow dropdown dropleft"><i
                                                        class="fas fa-ellipsis-h" data-toggle='dropdown'></i>
                                                    <div class="dropdown-menu ">
                                                        <a href="" class="dropdown-item">Bao cao noi dung</a>
                                                        <a href="" class="dropdown-item">Theo doi</a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="info-content">

                                            <div class="num-star">
                                                <span class="star">
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                    <i class="fa fa-star checked"></i>
                                                </span>
                                            </div>
                                            <div class="content">
                                                <h1 class="title">{{$rating->title}}</h1>
                                                <p>{{$rating->content}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="row padding">
				  				<div class="col-12">
				  					<div class="info-user d-flex mb-3">
				  						<a href="" class="avatar d-block"><img src="image/image_avatar/images.jpg" alt=""></a>
				  						<div class="username-time ml-3 d-flex justify-content-between w-100">
				  							<div>
				  								<a href="" class="username">Hoangven</a>
					  							<span class="time">đã viết đánh giá vào 10/12/2020</span>
				  							</div>
				  							<div class="report-follow dropdown dropleft"><i class="fas fa-ellipsis-h" data-toggle='dropdown'></i>
				  								<div class="dropdown-menu ">
				  									<a href="" class="dropdown-item">Bao cao noi dung</a>
				  									<a href="" class="dropdown-item">Theo doi</a>
				  								</div>
				  							</div>
				  						</div>

				  					</div>
				  					<div class="info-content">
				  						
				  						<div class="image">
				  							
				  							<div class="row">
				  								
				  								<div class="col-6 col-sm-6 col-md-3"><img src="image/image_avatar/images.jpg" alt=""></div>
				  									
				  							</div>		  							
				  						</div>
				  						
				  						<div class="num-star">
				  							<span class="star">
				  								<i class="fa fa-star checked"></i>
				  								<i class="fa fa-star checked"></i>
				  								<i class="fa fa-star checked"></i>
				  								<i class="fa fa-star checked"></i>
				  								<i class="fa fa-star checked"></i>
											</span>
				  						</div>
				  						<div class="content">
				  							<h1 class="title">canh dep</h1>
				  							<p>canh dep</p>
				  						</div>
				  					</div>
				  				</div>
				  			</div> -->
                                @endforeach
                                @endif


                            </div>

                        </div>
                        <!-- COMMENT -->
                        <div class=" tab-pane" id="comment">
                            <div class="row d-flex justify-content-between p-3 bg-white">
                                <div class="dropdown col-6 text-cdenter border-bottom pb-1">
                                    <button type="button" class="btn btn-dark dropdown-toggle w-2"
                                        data-toggle="dropdown">Viết bình luận</button>
                                    <div class="dropdown-menu">
                                        <a href="" class="dropdown-item">Viết đánh giá</a>
                                        <a href="" class="dropdown-item">Đăng ảnh</a>
                                        <a href="" class="dropdown-item" data-toggle='modal'
                                            data-target='#myCommentQuestion'>Viết bình luận</a>
                                    </div>
                                </div>
                                <div class="col-6  border-bottom pb-1">
                                    <h1 class="title text-cdenter">Bình luận</h1>
                                </div>

                            </div>
                            <div class="info-user-content">
                                @if(count($comments) > 0)
                                @foreach($comments as $comment)
                                @if($comment->parent_id == 0)
                                <div class="row padding comment{{$comment->id}}">

                                    <div class="col-12">

                                        <div class="parent-comment">
                                            <div class="info-user d-flex mb-3">
                                                <a href="" class="avatar d-block"><img
                                                        src="image/image_avatar/{{$comment->user->avatar}}" alt=""></a>
                                                <div class="username-time ml-3 d-flex justify-content-between w-100">
                                                    <div>
                                                        <a href="" class="username">{{$comment->user->username}}</a>
                                                        <span class="time">đã bình luận vào
                                                            {{$comment->created_at->format('d-m-Y')}}</span>
                                                    </div>
                                                    <div class="report-follow dropdown dropleft"><i
                                                            class="fas fa-ellipsis-h" data-toggle='dropdown'></i>
                                                        <div class="dropdown-menu ">
                                                            <a href="" class="dropdown-item">Bao cao noi dung</a>
                                                            <a href="" class="dropdown-item">Theo doi</a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="content">
                                                <p>{{$comment->content}}</p>
                                            </div>
                                        </div>
                                        <!-- comment child -->
                                        <div class="list-child-comment">
                                            @foreach($comments as $comment_child)
                                            @if($comment_child->parent_id == $comment->id)
                                            <div class="child-comment child-comment-{{$comment_child->id}}">
                                                <div class="info-user d-flex mb-3">
                                                    <a href="" class="avatar d-block"><img
                                                            src="image/image_avatar/{{$comment_child->user->avatar}}"
                                                            alt=""></a>
                                                    <div
                                                        class="username-time ml-3 d-flex justify-content-between w-100">
                                                        <div>
                                                            <span class="time">Câu trả lời từ</span>
                                                            <a href=""
                                                                class="username">{{$comment_child->user->username}}</a>
                                                            <span
                                                                class="time d-flex">{{$comment_child->created_at->format('d-m-Y')}}</span>

                                                        </div>
                                                        <div class="report-follow dropdown dropleft"><i
                                                                class="fas fa-ellipsis-h" data-toggle='dropdown'></i>
                                                            <div class="dropdown-menu ">
                                                                <a href="" class="dropdown-item">Bao cao noi dung</a>
                                                                <a href=""
                                                                    class="dropdown-item delete-comment-topic">Xóa

                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="content">
                                                    <p>{{$comment_child->content}}</p>
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                        <!-- form comment -->
                                        <div class="wp-form-comment child-comment d-flex p-2">
                                            <a href="" class="avatar d-inline-block"><img
                                                    src="https://img3.thuthuatphanmem.vn/uploads/2019/06/08/hinh-nen-hotgirl-duyen-dang_125438813.jpg"
                                                    alt=""></a>
                                            <form method="post" class="w-100 pl-2 form-comment-child">
                                                <textarea name="content" class="w-50 input-text"
                                                    placeholder="Nhap noi dung vao day..."></textarea>
                                                <input type="hidden" class="parent-id" value="{{$comment->id}}">
                                                <input type="hidden" class="topic-id" value="{{$topic->id}}">
                                                <div class="pt-4 show-btn">
                                                    <button class="btn btn-primary btn-send mr-2"
                                                        disabled="">Send</button>
                                                    <button class="btn btn-danger btn-destroy">Huy</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                                @endif
                                @endforeach
                                @endif

                            </div>

                        </div>


                    </div>
                </div>
            </div>

            <!-- popup user write question , comment -->
            <div class="modal" id="myCommentQuestion">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="fas fa-edit mr-2 "></i>Đặt câu hỏi, bình luận</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <h1>Mời bạn đặt câu hỏi hoặc bình luận</h1>
                            <div class="wp-form-comment d-flex">
                                <a href="" class="avatar d-inline-block mr-2"><img
                                        src="image/image_avatar/{{Auth::user()->avatar}}" alt=""></a>
                                <form action="{{url('topic/comment')}}/{{$topic->id}}" method="post" class="w-100"
                                    id="form-comment">
                                    @csrf
                                    <textarea id="content-comment" class="w-100" rows="10" placeholder="Mời bạn nhập..."
                                        name="content_comment"></textarea>
                                    <button class="btn btn-primary send-comment" disabled="true">Send</button>


                                    <button class="btn btn-danger" data-dismiss="modal">Huy</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- popup rating place -->
            <div class="modal" id="myRatingPlace">
                <div class="modal-dialog modal-lg">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="fas fa-edit mr-2"></i>Đánh giá về {{$topic->name}}</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="locationInfo mb-3 d-flex">
                                <div class="thumbnail mr-2"><img
                                        src="image/image_place/{{json_decode($topic->image)[0]}}" class="rounded"
                                        alt=""></div>
                                <div class="name-address">
                                    <p class="name">{{$topic->name}}</p>
                                    <p class="addres"><i class="fas fa-map-marker-alt"></i>{{$topic->address}}</p>
                                </div>
                            </div>
                            <div class="wp-form-rating">
                                <form action="{{url('topic/rating')}}/{{$topic->id}}" method="post" id="formRating"
                                    name="formRating" enctype="multipart/form-data">
                                    @csrf
                                    <div class="rating-header">
                                        <div class="labelHeader">Xếp hạng trải nghiệm của bạn</div>
                                        <div class="input-star rating">
                                            <input type="radio" name="num_star" value="5" id="5"><label
                                                for="5">☆</label>
                                            <input type="radio" name="num_star" value="4" id="4"><label
                                                for="4">☆</label>
                                            <input type="radio" name="num_star" value="3" id="3"><label
                                                for="3">☆</label>
                                            <input type="radio" name="num_star" value="2" id="2"><label
                                                for="2">☆</label>
                                            <input type="radio" name="num_star" value="1" id="1"
                                                checked="checked"><label for="1">☆</label>
                                        </div>
                                    </div>
                                    <div class="rating-content">
                                        <div class="form-group">
                                            <label for="email">Đặt tiêu đề cho đánh giá của bạn<span
                                                    class="text-danger">(bắt buộc *)</span></label>
                                            <textarea name="title" class="form-control title-rating"
                                                cols="30"></textarea>
                                        </div>
                                        <p class="form-error" id="error-title"></p>
                                        <div class="form-group">
                                            <label for="email">Nội dung đánh giá <span class="text-danger">(bắt buộc
                                                    *)</span></label>
                                            <textarea name="content" class="form-control content-rating" id="" cols="30"
                                                rows="5"></textarea>

                                        </div>
                                        <p class="form-error" id="error-content"></p>

                                        <div class="form-group">
                                            <button class="btn btn-success w-100">Send</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>
            </div>



        </div>
    </div>
    <!-- XU LÝ HIỂN THỊ CÁC ĐỊA ĐIỂM GẦN LÊN BẢN ĐỒ -->

    @endsection
    @section('script')
    <script src="js/uploadfile.js"></script>

    <script>
    // ==Alert rating success
    var topic_comment = '{{Session::has('
    comment_topic_success ')}}';
    if (topic_comment) {
        toastr.success('Đã gửi bình luận', '', {
            timeOut: 1500
        })
    }
    var exist = '{{Session::has('
    rating_success ')}}';
    if (exist) {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Đã gửi đánh giá !',
            timer: 1500
        })
    }
    // == BINH LUAN TOPIC ===
    commentTopic();

    function commentTopic() {
        $('.form-comment-child').on('submit', function(e) {
            var content = $(this).find('.input-text').val();
            var parent_id = $(this).find('.parent-id').val();
            var topic_id = $(this).find('.topic-id').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'topic/comment-ajax',
                dataType: 'json',
                data: {
                    parent_id: parent_id,
                    content: content,
                    topic_id: topic_id
                },
                type: 'post',
                success: function(data) {
                    console.log(data);
                    if (data.success) {
                        $('.comment' + parent_id + ' .list-child-comment').append(data.html);
                    }
                }
            })
            e.preventDefault()
        })
    }
    $('.form-comment-child .input-text').on('change keyup paste', function() {
        var parent_id = $(this).next('.parent-id').val();
        if ($(this).val() == '') {
            $('.comment' + parent_id + ' .btn-send').attr('disabled', 'disabled');
        } else {
            $('.comment' + parent_id + ' .btn-send').removeAttr('disabled')
        }

    })
    // == DANH GIA TOPIC ==
    $('#formRating').on('submit', function(e) {
        var title = document.formRating.title.value;
        var content = document.formRating.content.value;
        document.getElementById('error-title').innerHTML = '';
        document.getElementById('error-content').innerHTML = '';
        if (title == "" || content == "") {

            if (title == "") {
                // alert('trong');
                document.getElementById('error-title').innerHTML = 'Tiêu đề không được trống!';
            }
            if (content == "") {
                document.getElementById('error-content').innerHTML = 'Nội dung đánh giá không được trống!';
            }
            e.preventDefault();
        }


    })


    // ==Event on change texarea comment==
    $('#content-comment').on('change keyup paste', function() {
        if ($(this).val() == '') {
            $('.send-comment').attr('disabled', 'disabled');
        } else {
            $('.send-comment').removeAttr('disabled')
        }
        // alert($(this).val());
    })
    </script>
    <script>
    function initMap() {
        var lat = <?= $topic->lat ?>;
        var lng = <?= $topic->lng ?>;
        var a = 9

        var location = {
            lat: lat,
            lng: lng
        };

        var myOption = {
            mapTypeControl: false,
            center: location,
            zoom: 13
        }
        var map_small = new google.maps.Map(document.getElementById('map-small'), myOption);
        var map_lag = new google.maps.Map(document.getElementById('map-lag'), myOption);
        // marker in map small
        var marker = new google.maps.Marker({
            position: location,
            map: map_small

        });
        // marker in map lag
        var marker_lag = new google.maps.Marker({
            position: location,
            map: map_lag
        });


        // end cac diem lien quan
        var content = '<div class="infowindow-content">' +
            '<div class="image"><img src="image/image_place/{{$image_topic[0]}}"alt=""></div>' +
            '<a href="" class="title">{{$topic->name}}</a>'

            +
            '<div class="star"><i class="fa fa-star checked"></i>' +
            '<i class="fa fa-star checked"></i>' +
            '<i class="fa fa-star checked"></i>' +
            '<i class="fa fa-star checked"></i>' +
            '<i class="fa fa-star checked"></i>' +
            '</div>' +
            '<div class="address">' +
            '<b>{{$topic->address}}</b>' +
            '</div>' +
            '<p class="lat">Vĩ độ:' + location.lat + '</p>' +
            '<p class="lng">Kinh độ:' + location.lng + '</p>' +
            '</div>';
        var infowindow = new google.maps.InfoWindow({
            content: content
        });
        google.maps.event.addListener(marker_lag, 'click', function() {
            // infowindow.setContent(content);
            infowindow.open(map_lag, marker_lag);

        });
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.setContent(content);
            infowindow.open(map_lag, marker);
        });
    }
    </script>
    <script>
    $(".owl-carousel").owlCarousel({

        // autoPlay: 3000,
        items: 4,
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [979, 3],
        center: true,
        nav: true,
        loop: true,

        // responsive: {
        //     600: {
        //         items: 4
        //     }
        // }
    });
    </script>
    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAooDY7d6iFESb-veaQGNNeSVrb_isnJUI&callback=initMap" async
        defer></script>
    @endsection