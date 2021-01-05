@extends('layouts.index')
@section('content')
<?php 
$image_topic = json_decode($topic->image);
if(Auth::check()){
   $user_id = Auth::user()->id; 
}

?>
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
                    <div style="padding: 15px 15px 5px 15px">
                        <div class="row">
                            <?php 
                            $i =0 ;
                            $num_images = count($images);
                            ?>
                            @foreach($images as $image)
                            <?php $i++ ?>
                            @if($i <= 5) <div class="col-4 thumb">
                                <img src="image/image_place/{{$image}}" class="img-fluid mb-2" alt="white sample"
                                    data-toggle='modal' data-target='#modalImage'>
                        </div>
                        @endif
                        @if($i ==6)
                        <div class="col-4 thumb thumb-relative">
                            <img src="image/image_avatar/images.jpg" alt="">
                            <div class="overlayy " data-toggle='modal' data-target='#modalImage'>
                                <div class="number"><span>+{{$num_images - 6}}</span></div>
                            </div>
                        </div>
                        @endif
                        @endforeach



                    </div>
                </div>
                <!-- Them hinh anh cho dia diem -->
                <div class="d-flex justify-content-between">
                    @if(Auth::check())
                    <div class="add-images btn" data-toggle="modal" data-target="#modalAddImages"><i
                            class="fas fa-camera"></i> Thêm hình ảnh</div>
                    @endif
                    <div class="btn btn-default text-danger" data-toggle="modal" data-target="#ModalReportTopic">! Báo cáo</div>
                </div>
                <div id="modalAddImages" class=modal>
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Thêm hình ảnh</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form id="formAddImagesTopic" enctype="multipart/form-data">
                                    <div class="row">
                                        <div id="reviewimg"></div>

                                    </div>
                                    <!-- Input hidden -->
                                    <div class="form-group">
                                        <label for="email">Tải ảnh lên</label>
                                        <p class="form-error" id="error-file"></p>
                                        <div class="choseFile custom-file">
                                            <input type="file" class="custom-file-input" multiple=""
                                                id="uploadImgAddTopic" name="image[]">
                                            <div class="icon-image"></div>
                                            <!-- image delete -->
                                            <div id="file_hidden"></div>
                                            <input type="hidden" id="file_name_image_delete" name="file_delete">
                                            <input type="hidden" name=topic_id value={{$topic->id}}>
                                        </div>
                                    </div>

                                    <div class="d-none alert alert-default-primary w-100 mb-1 mt-2">
                                        Đăng ảnh thành công!</div>

                                    <div class="form-group ">
                                        <button class="btn btn-success w-100">Đăng ảnh</button>

                                    </div>

                                    <!-- End Input hidden -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal report topic -->
                <div id="ModalReportTopic" class="modal fade">
                    <div class="modal-dialog">
                        <form action="" class="form-report-topic">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Báo cáo chủ đề này</h4>
                                    <button type="button" class="close" data-dismiss="modal">X</button>
                                    
                                </div>
                                <div class="modal-body">

                                    <textarea class="form-control content-report" name="reason" rows="5" placeholder="Lý do báo cáo chủ đề này..."></textarea>
                                    <!-- success report -->
                                    <div class="mt-2 alert alert-default-primary d-none">Đã gửi nội dung báo cáo!</div>
                                    <input type="hidden" name="topic_id" value="{{$topic->id}}" class="id_topic_report">
                                </div>        
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success send-report" disabled="disabled">Gửi</button>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
                <!-- ./Modal report topic -->
            </div>
            <div class="col-lg-4 col-md-12 sidebar border-left">
                <div class="location " style="padding: 15px 0px">
                    <h1> Vị Trí</h1>
                    <div class="address">
                        <span><i class="fas fa-map-marker-alt"></i></span>
                        <span>{{$topic->address}}</span>
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
                                @foreach($images as $image)
                                <div class="item"> <img src="image/image_place/{{$image}}" alt="image" /> </div>
                                @endforeach

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End image topic -->
        <!-- Start post topic -->
        <div class="row" style="background:white">
            <!-- Tổng hợp các bài viết về topic này -->
            <div class="col-md-12 col-lg-8 post-content">
                <div class="container">
                    <div class="row mt-2 mb-2">
                        <div class="col-12 near-location">
                            Review, Chia sẻ kinh nghiệm
                        </div>
                    </div>
                   
                    <!-- Bai viet review -->
                    <div class="row post-feature">

                        <div class="col-12 p-0">
                            <div class="category">
                                <h2>Các bài review</h2>
                            </div>
                            @if(count($post_review) > 0)
                            <ul class="list-post mb-2">
                                @foreach($post_review as $post)
                                <li class="d-flex pr-2 post-review-{{$post->id}}">
                                    <a href="#" class="avatar d-block mr-3"><img class="img-50"
                                            src="image/image_avatar/{{$post->user->avatar}}" alt=""></a>
                                    <div class="info-desc">
                                        <div class="topic-title">
                                            @if($post->category == 'review')
                                            <span class="topic">[Review]</span>
                                            @else
                                            <span class="topic">[Kinh nghiệm]</span>
                                            @endif
                                            <a href="{{url('topic/post/detail')}}/{{$post->id}}"
                                                class="title">{{$post->title}}</a>
                                        </div>
                                        <div class="time mt-2"><i class="fas fa-calendar-alt mr-1"></i>
                                            {{$post->created_at->format('d-m-Y')}}</div>
                                    </div>
                                    @if(Auth::check())
                                    <div class="report-follow dropdown dropleft ml-auto"><i class="fas fa-ellipsis-h"
                                            data-toggle='dropdown'></i>
                                        <div class="dropdown-menu ">
                                            @if(isCreatePost($post->id,$user_id))
                                            <a class="dropdown-item" data-toggle="modal" data-target="#reportPostTopic{{$post->id}}">Báo cáo</a>
                                            <a href="{{url('topic/edit-post')}}/{{$post->id}}" class="dropdown-item">Chỉnh sửa</a>
                                            <a href="" class="dropdown-item delete-post">Xóa
                                                <input type="hidden" class="delete-post-id" value="{{$post->id}}">
                                            </a>
                                            @else
                                            <a class="dropdown-item" data-toggle="modal" data-target="#reportPostTopic{{$post->id}}">Báo cáo</a>
                                            @endif
                                        </div>
                                    </div>
                                    @endif
                                    <!-- bao cao noi dung -->
                                    <div id="reportPostTopic{{$post->id}}" class="modal fade">
                                        <div class="modal-dialog">
                                            <form action="" class="form-report-post">

                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Báo cáo bài viết</h4>
                                                        <button type="button" class="close" data-dismiss="modal">X</button>
                                                        
                                                    </div>
                                                    <div class="modal-body">

                                                        <textarea class="form-control content-report" name="reason" rows="5" placeholder="Lý do báo cáo bài viết..."></textarea>
                                                        <!-- success report -->
                                                        <div class="mt-2 alert alert-default-primary d-none">Đã gửi nội dung báo cáo!</div>
                                                        <input type="hidden" name="post_id" value="{{$post->id}}" class="id_post_report">
                                                    </div>
                                                    
                                
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success send-report" disabled="disabled">Gửi</button>
                                                    </div>
                                                    
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- ./bao cao noi dung -->
                                </li>
                                @endforeach

                            </ul>
                            <!-- phan trang -->

                            <div style="" class="d-flex justify-content-center">{!!$post_review->links()!!}</div>

                            @else
                            <div class="alert alert-default-success">Chưa có bài chia sẻ nào về địa điểm này</div>
                            @endif
                        </div>

                    </div>
                    <!-- Chia ser kinh nghiem -->
                    <div class="row post-feature mt-4 mb-3">
                        <div class="col-12 p-0">
                            <div class="category">
                                <h2>Các bài chia sẻ kinh nghiệm</h2>
                            </div>
                            @if(count($post_review1) > 0)
                            <ul class="list-post mb-2">
                                @foreach($post_review1 as $post)
                                <li class="d-flex pr-2 post-review-{{$post->id}}">
                                    <a href="#" class="avatar d-block mr-3"><img class="img-50"
                                            src="image/image_avatar/{{$post->user->avatar}}" alt=""></a>
                                    <div class="info-desc">
                                        <div class="topic-title">
                                            @if($post->category == 'review')
                                            <span class="topic">[Review]</span>
                                            @else
                                            <span class="topic">[Kinh nghiệm]</span>
                                            @endif
                                            <a href="{{url('topic/post/detail')}}/{{$post->id}}"
                                                class="title">{{$post->title}}</a>
                                        </div>
                                        <div class="time mt-2"><i class="fas fa-calendar-alt mr-1"></i>
                                            {{$post->created_at->format('d-m-Y')}}</div>
                                    </div>
                                    @if(Auth::check())
                                    <div class="report-follow dropdown dropleft ml-auto"><i class="fas fa-ellipsis-h"
                                            data-toggle='dropdown'></i>
                                        <div class="dropdown-menu">
                                            @if(isCreatePost($post->id,$user_id))
                                            <a class="dropdown-item" data-toggle="modal" data-target="#reportPostTopic{{$post->id}}">Báo cáo</a>
                                            <a href="{{url('topic/edit-post')}}/{{$post->id}}" class="dropdown-item">Chỉnh sửa</a>
                                            <a href="" class="dropdown-item delete-post">Xóa
                                                <input type="hidden" class="delete-post-id" value="{{$post->id}}">
                                            </a>
                                            @else
                                            <a class="dropdown-item" data-toggle="modal" data-target="#reportPostTopic{{$post->id}}">Báo cáo</a>
                                            @endif
                                        </div>
                                    </div>
                                    @endif
                                    <!-- bao cao noi dung -->
                                    <div id="reportPostTopic{{$post->id}}" class="modal fade">
                                        <div class="modal-dialog">
                                            <form class="form-report-post" >
                                                
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Báo cáo bài viết</h4>
                                                        <button type="button" class="close" data-dismiss="modal">X</button>
                                                        
                                                    </div>
                                                    <div class="modal-body">
                                                        <textarea class="form-control content-report" name="reason" rows="5" placeholder="Lý do báo cáo bài viết..."></textarea>
                                                        <!-- success report -->
                                                        
                                                        <div class="mt-2 alert alert-default-primary d-none">Đã gửi nội dung báo cáo!</div>
                                                        <input type="hidden" name="post_id" value="{{$post->id}}" class="id_post_report">
                                                    </div>
                                                    
                                
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success send-report" disabled="disabled">Gửi</button>
                                                    </div>
                                                    
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- ./bao cao noi dung -->
                                </li>
                                @endforeach

                            </ul>
                            <!-- phan trang -->

                            <div style="" class="d-flex justify-content-center">{!!$post_review1->links()!!}</div>

                            @else
                            <div class="alert alert-default-success">Chưa có bài chia sẻ nào về địa điểm này</div>
                            @endif
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
                            <span class="number text-danger">{{count($place_near)}}</span>
                            <span class="category-name text-danger">Điểm đến khác</span>
                            <span class="range">Trong phạm vi 10km</span>
                        </span>
                        <ul class="list-place row">
                            @foreach($place_near as $place)
                            <li class="col-lg-12 col-md-6 d-flex">
                                <a href="topic/{{$place->id}}" class="d-flex item">
                                    <div class="thumb w-50">
                                        <img class="rounded" src="image/image_place/{{json_decode($place->image)[0]}}" alt="">
                                       <!--  <span class="price">54645 đ</span> -->
                                    </div>
                                    <div class="info w-50">
                                        <div class="title">
                                            <h1>{{$place->name}}</h1>
                                        </div>
                                        <!-- <h1 class="title">hotel1</h1> -->
                                        <div class="addresss">
                                            <i class="fas fa-map-marker-alt"></i>
                                            {{$place->address}}
                                        </div>
                                        <div class="star-date d-flex flex-column pt-1">
                                            <span class="date">{{$place->KM}} Km</span>
                                            <span class="star mt-2">
                                                @if(avgStartTopic($place->id) > 0)
                                                @for($i = 0;$i<= floor(avgStartTopic($place->id));$i++)
                                                <span class="fa fa-star checked"></span>
                                                @endfor
                                                @else
                                                0 <span class="fa fa-star checked"></span>
                                                @endif
                                                                                     
                                            </span>
                                            
                                            
                                        </div>
                                        
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>


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
                    <div class="send-rating" data-toggle='modal' data-target='#myRatingPlace'>Gửi đánh giá</div>
                </div>
            </div>
        </div>

        <!-- Cac nha hang khach san xung quanh dia diem -->

        <div class="row card mt-2 carwl-data">
            <div class="near-location">Các địa điểm lân cận</div>
            <!-- Du lieu Carwl Mytour -->
            @if($data_carwl != false)
            <div class="main-title">
                <h1>Khách Sạn</h1>
            </div>
            <div class="owl-carousel">
                @foreach($data_carwl['title_name'] as $key => $value)
                <div class="item">
                    <a href="https://mytour.vn/<?php echo $data_carwl['links'][$key] ?>" target="_blank">
                        <img src="<?php echo $data_carwl['images'][$key] ?>" alt="" class="img-fluid rounded">
                    </a>
                    <div class="info">
                        <div class="title">
                            <a href="https://mytour.vn/<?php echo $data_carwl['links'][$key] ?>"
                                target="_blank"><?php echo $value ?></a>
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
            <div class="main-title">
                <h1>Khách Sạn,Nhà Hàng, Điểm du lịch</h1>
            </div>
            <div class="owl-carousel">
                @foreach($cat_tripadvisor as $key => $value)
                @foreach($data_tripadvisor as $item)
                @if($item->category->name == $key)
                <div class="item">
                    <div class="category">{{$value}}</div>
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
                @endif
                @endforeach
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
                                <span class="number">{{count($topic->ratings)}}</span>
                                <span class="name">Đánh giá</span>
                            </a>
                        </li>
                        <li class="nav-item col-6 bg-ignfo text-center">
                            <a class="nav-link d-flex flex-column" data-toggle="tab" href="#comment">
                                <span><i class="far fa-comment-alt"></i></span>
                                <span class="number">{{count($topic->comments)}}</span>
                                <span class="name">Bình luận</span>
                            </a>
                        </li>


                    </ul>

                </div>
                <div class="tab-content">
                    <!-- RATING -->
                    <div class=" tab-pane active" id="rating">
                        <div class="row d-flex justify-content-between p-3 bg-white">
                            @if(Auth::check())
                            <div class="dropdown col-6 text-cdenter border-bottom pb-1">
                                <button type="button" class="btn btn-dark dropdown-toggle w-2"
                                    data-toggle="dropdown">Viết đánh giá</button>
                                <div class="dropdown-menu">
                                    <a href="" class="dropdown-item" data-toggle='modal'
                                        data-target='#myRatingPlace'>Viết đánh giá</a>
                                    <a href="" class="dropdown-item " data-toggle='modal'
                                        data-target='#myCommentQuestion'>Viết bình luận</a>
                                </div>
                            </div>
                            @endif
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
                                            <div class="report-follow dropdown dropleft"><i class="fas fa-ellipsis-h"
                                                    data-toggle='dropdown'></i>
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

                            @endforeach
                            @endif


                        </div>

                    </div>
                    <!-- COMMENT -->
                    <div class=" tab-pane" id="comment">
                        <div class="row d-flex justify-content-between p-3 bg-white">
                            @if(Auth::check())
                            <div class="dropdown col-6 text-cdenter border-bottom pb-1">
                                <button type="button" class="btn btn-dark dropdown-toggle w-2"
                                    data-toggle="dropdown">Viết bình luận</button>
                                <div class="dropdown-menu">
                                   <a href="" class="dropdown-item" data-toggle='modal'
                                        data-target='#myRatingPlace'>Viết đánh giá</a>
                                    
                                    <a href="" class="dropdown-item" data-toggle='modal'
                                        data-target='#myCommentQuestion'>Viết bình luận</a>
                                </div>
                            </div>
                            @endif
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
                                                @if(Auth::check())
                                                @if(checkCommentTopic(Auth::user()->id,$comment->id))
                                                <div class="report-follow dropdown dropleft"><i
                                                        class="fas fa-ellipsis-h" data-toggle='dropdown'></i>
                                                    <div class="dropdown-menu ">
                                                        <a href="" class="dropdown-item">Bao cao noi dung</a>
                                                        <a  class="delete-comment dropdown-item">Xóa
                                                            <input type="hidden" class="hidden-comment" value="parent">
                                                            <input type="hidden" class="hidden-comment-id" value="{{$comment->id}}">
                                                        </a>
                                                    </div>
                                                </div>
                                                @endif
                                                @endif
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
                                                <div class="username-time ml-3 d-flex justify-content-between w-100">
                                                    <div>
                                                        <span class="time">Câu trả lời từ</span>
                                                        <a href=""
                                                            class="username">{{$comment_child->user->username}}</a>
                                                        <span
                                                            class="time d-flex">{{$comment_child->created_at->format('d-m-Y')}}</span>

                                                    </div>
                                                    @if(Auth::check())
                                                    @if(checkCommentTopic(Auth::user()->id,$comment_child->id))
                                                    <div class="report-follow dropdown dropleft"><i
                                                            class="fas fa-ellipsis-h" data-toggle='dropdown'></i>
                                                        <div class="dropdown-menu ">
                                                            
                                                            <a class="dropdown-item delete-comment">Xóa
                                                                <input type="hidden" class="hidden-comment" value="child">
                                                                <input type="hidden" class="hidden-comment-id" value="{{$comment_child->id}}">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @endif
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
                                    @if(Auth::check())
                                    <div class="wp-form-comment child-comment d-flex p-2">
                                        <a href="" class="avatar d-inline-block"><img
                                                src="image/image_avatar/{{Auth::user()->avatar}}"
                                                alt=""></a>
                                        <form method="post" class="w-100 pl-2 form-comment-child">
                                            
                                            <textarea name="content" class="w-50 input-text"
                                                placeholder="Nhap noi dung vao day..."></textarea>
                                            
                                            <input type="hidden" class="parent-id" value="{{$comment->id}}">
                                            <input type="hidden" class="topic-id" value="{{$topic->id}}">
                                            <div class="pt-4 show-btn">
                                                <button class="btn btn-primary btn-send mr-2" disabled="">Gửi</button>
                                                <button class="btn btn-danger btn-destroy">Hủy</button>
                                            </div>
                                        </form>
                                    </div>
                                    @endif
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
        @if(Auth::check())
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
                                <button class="btn btn-primary send-comment" disabled="true">Gửi</button>


                                <button class="btn btn-danger" data-dismiss="modal">Hủy</button>
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
                            <div class="thumbnail mr-2"><img src="image/image_place/{{json_decode($topic->image)[0]}}"
                                    class="rounded" alt=""></div>
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
                                        <input type="radio" name="num_star" value="5" id="5"><label for="5">☆</label>
                                        <input type="radio" name="num_star" value="4" id="4"><label for="4">☆</label>
                                        <input type="radio" name="num_star" value="3" id="3"><label for="3">☆</label>
                                        <input type="radio" name="num_star" value="2" id="2"><label for="2">☆</label>
                                        <input type="radio" name="num_star" value="1" id="1" checked="checked"><label
                                            for="1">☆</label>
                                    </div>
                                </div>
                                <div class="rating-content">
                                    <div class="form-group">
                                        <label for="email">Đặt tiêu đề cho đánh giá của bạn<span
                                                class="text-danger">(bắt buộc *)</span></label>
                                        <textarea name="title" class="form-control title-rating" cols="30"></textarea>
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
                                        <button class="btn btn-success w-100">Gửi</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        @endif



    </div>
</div>
<!-- XU LÝ HIỂN THỊ CÁC ĐỊA ĐIỂM GẦN LÊN BẢN ĐỒ -->

@endsection
@section('script')
<script src="js/uploadfile.js"></script>

<script>
// ====Delete post review====
$('.delete-post').click(function(e){
    var r = confirm("Bạn có chắc muốn xóa bài viết này?");
    var post_id = $(this).find('.delete-post-id').val();
    if(r == true){
        e.preventDefault();
       
        var post_id = $(this).find('.delete-post-id').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{url('topic/delete-post')}}",
            dataType:'json',
            data: {post_id:post_id},
            type:'post',
            success:function(data){
                console.log(data)
                $('.post-review-'+post_id).remove();
            }
        })
    }
    
})
// ====REPORT POST ON TOPIC=====
<?php
if(Auth::check()){
?>
var user_id = '{{Auth::user()->id}}';

<?php
}
?>
var topic_id = '{{$topic->id}}'
// report topic
reportTopic();
function reportTopic(){
    $('.form-report-topic').on('submit',function(e){
        e.preventDefault();
        var data = new FormData(this);
        $(this).find('.content-report').val('');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{url('topic/report-topic')}}",
            dataType:'json',
            data: data,
            type:'post',
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                console.log(data)
                $('.alert-default-primary').removeClass('d-none');
                var a = setInterval(function(){ 
                    $('.alert-default-primary').addClass('d-none');
                    
                    $('#ModalReportTopic').modal('hide');   
                    clearInterval(a);
                }, 2500);  
            }
        })
    })
}
disableReport();
sendReport();
function sendReport(){
    $('.form-report-post').on('submit',function(e){
        e.preventDefault()
        
        var data = new FormData(this);
        var post_id = $(this).find('.id_post_report').val();
    
        $(this).find('.content-report').val('');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{url('topic/report-post')}}",
            dataType:'json',
            data: data,
            type:'post',
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                console.log(data)
                $('.alert-default-primary').removeClass('d-none');
                var a = setInterval(function(){ 
                    $('.alert-default-primary').addClass('d-none');
                    
                    $('#reportPostTopic'+post_id).modal('hide');   
                    clearInterval(a);
                }, 2500);  
            }
        })
       
       
    })
}
function disableReport(){
    $('.content-report').on('change keyup paste',function(){
        
        if($(this).val() == ''){
            $('.send-report').attr('disabled','disabled');   
        }else{
            $('.send-report').removeAttr('disabled')
        }
        
    })
}
// === XOA BINH LUAN=== 
delete_comment();
function delete_comment(){
    $('.delete-comment').on('click',function(e){
        var check = confirm("Bạn có muốn xóa bình luân này?");
        var level = $(this).find('.hidden-comment').val();
        var id = $(this).find('.hidden-comment-id').val();
        var topic_id = '{{$topic->id}}'
        
        
        if (check == true) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'topic/delete-comment-ajax',
                dataType: 'json',
                data: {
                    level: level,
                    id: id,
                    topic_id: topic_id
                },
                type: 'post',
                success: function(data) {
                    console.log(data);
                    
                    if(data.ok.level == 'parent'){
                        $('.comment'+data.ok.id).remove();
                    }
                    if(data.ok.level == 'child'){
                        $('.child-comment-'+data.ok.id).remove();
                    }
                }
            })
        }
      
    })
}
// ==Alert rating success
var topic_comment = '{{Session::has('comment_topic_success')}}';
if (topic_comment) {
    toastr.success('Đã gửi bình luận', '', {
        timeOut: 1500
    })
}
var exist = '{{Session::has('rating_success')}}';
if (exist) {
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Đã gửi đánh giá !',
        // timer: 1500,
        button:'ok'
    })
}
var checkin = '{{Session::has('checkin_success')}}';
if (checkin) {
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Đăng bài thành công !',
        // timer: 1500,
        button:'ok'
    })
}

// === Dong gop hinh anh===
$('#formAddImagesTopic').on('submit', function(e) {
    e.preventDefault();

    var data = new FormData(this);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'topic/add-images',
        type: 'post',
        dataType: 'json',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            console.log(data);
            $('#formAddImagesTopic .alert-default-primary')
                .removeClass('d-none');
            var a = setInterval(function() {
                $('#formAddImagesTopic .alert-default-primary')
                    .addClass('d-none');

            }, 2000);
            location.reload();
        }
    })
})
// == BINH LUAN TOPIC ===
commentTopic();

function commentTopic() {
    $('.form-comment-child').on('submit', function(e) {
        var content = $(this).find('.input-text').val();
        var parent_id = $(this).find('.parent-id').val();
        var topic_id = $(this).find('.topic-id').val();
        $(this).find('.input-text').val('');
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
                    delete_comment();
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
        '<a href="topic/{{$topic->id}}" class="title">{{$topic->name}}</a>'

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