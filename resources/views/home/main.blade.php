@extends('layouts.index')
@section('content')
@include('layouts.slider')
<div id="content">
    <div class="overview-country">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="main-title">
                        <h1>cuộc đời là những chuyến đi</h1>
                    </div>
                    <p class="main-sub-title">Bất tận những cảnh đẹp Việt Nam </p>
                </div>

            </div>
            <div class="row">
                <div class="col-md-5">
                    <a href="" class="h-100 d-block h-md-200 respon">
                        <img src="https://indochinapost.com/wp-content/uploads/chuyen-phat-nhanh-tu-sai-gon-di-Myanmar-gia-re-chuyen-nghiep-an-toan.jpg"
                            alt="">
                        <div class="text">
                            <h2>Miền Nam</h2>
                        </div>

                    </a>

                </div>
                <div class="col-md-7">
                    <a href="" class="height-2 d-block mb-20">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRjYczJsu_cc1AZgm5fFk9sgLvCrWBUmQ2G5g&usqp=CAU"
                            alt="">
                        <div class="text">
                            <h2>Miền Bắc</h2>
                        </div>
                    </a>
                    <a href="" class="height-2 d-block">
                        <img src="https://wiki-travel.com.vn/Uploads/picture/Thaophuongnguyen-172820042801-quang-7.jpg" alt="">
                        <div class="text">
                            <h2>Miền Trung</h2>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- introduce place -->
    <div class="features-places">
        <div class="container" id="bac-region">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="main-title">
                        <h1>bao la miền Bắc</h1>
                    </div>
                    <p class="main-sub-title">Bất tận những cảnh đẹp Việt Nam </p>
                </div>
            </div>
            <div class="row list-places owl-carousel ">
                @foreach($topic as $item)
                <div class="item-place item">
                    <a href="topic/{{$item->id}}" title=""><img src="image/image_place/{{json_decode($item->image)[0]}}"
                            alt="" class="img-fluid rounded h-200"></a>
                    <div class="info">
                        <a href="" class="title">{{$item->name}}</a>
                        <div class="star-date d-flex justify-content-between">
                            <span class="star">
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                            </span>
                            <span class="date">
                                <i class="fas fa-calendar-alt">{{$item->created_at->format('d-m-Y')}}</i>
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach


            </div>
        </div>
        <!-- mien trung -->
        <div class="container" id="bac-region">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="main-title">
                        <h1>rộng lớn miền Trung - nắng gió Tây Nguyên</h1>
                    </div>
                    <p class="main-sub-title">Bất tận những cảnh đẹp Việt Nam </p>
                </div>
            </div>

            <!-- Owlcarowsel -->
            <div class="row list-places">
                <div class="owl-carousel">
                    @for($i=1;$i<=5;$i++) <div class="item">
                        <a href="" title="">
                            <img src="https://www.hoaanit.com/travelshare/public/upload_image_blog/khach-san-gan-trung-tam.png"
                                alt="" class="h-200">

                        </a>
                        <div class="info">
                            <a href="" class="title">Chợ nổi cái răng </a>
                            <div class="star-date d-flex justify-content-between">
                                <span class="star">
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                </span>
                                <span class="date">
                                    <i class="fas fa-calendar-alt">15/09/2020</i>
                                </span>
                            </div>
                        </div>
                </div>
                <div class="item">
                    <a href="" title=""><img
                            src="https://www.hoaanit.com/travelshare/public/upload_image_blog/khach-san-gan-trung-tam.png"
                            alt="" class="img-fluid rounded"></a>
                    <div class="info">
                        <a href="" class="title">Chợ nổi cái răng2 </a>
                        <div class="star-date d-flex justify-content-between">
                            <span class="star">
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                            </span>
                            <span class="date">
                                <i class="fas fa-calendar-alt">15/09/2020</i>
                            </span>
                        </div>
                    </div>
                </div>
                @endfor

            </div>
        </div>
    </div>
    <!-- mien nam -->
    <div class="container" id="bac-region">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="main-title">
                    <h1>Miền Nam thân thương</h1>
                </div>
                <p class="main-sub-title">Bất tận những cảnh đẹp Việt Nam </p>
            </div>
        </div>
        <div class="row list-places owl-carousel">
            <div class="item-place item">
                <a href="" title="">
                    <img src="https://www.hoaanit.com/travelshare/public/upload_image_blog/khach-san-gan-trung-tam.png"
                        alt="" class="img-fluid rounded">

                </a>
                <div class="info">
                    <a href="" class="title">Chợ nổi cái răng </a>
                    <div class="star-date d-flex justify-content-between">
                        <span class="star">
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                        </span>
                        <span class="date">
                            <i class="fas fa-calendar-alt">15/09/2020</i>
                        </span>
                    </div>
                </div>

            </div>
            <div class="item-place item">
                <a href="" title=""><img
                        src="https://kenh14cdn.com/crop/640_360/2017/201707171029208104-1500637821156-564-0-1189-1000-crop-1500638323245.jpg"
                        alt="" class="img-fluid rounded"></a>
                <div class="info">
                    <a href="" class="title">Chợ nổi cái răng </a>
                    <div class="star-date d-flex justify-content-between">
                        <span class="star">
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                        </span>
                        <span class="date">
                            <i class="fas fa-calendar-alt">15/09/2020</i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="item-place item">
                <a href="" title=""><img
                        src="https://www.hoaanit.com/travelshare/public/upload_image_blog/khach-san-gan-trung-tam.png"
                        alt="" class="img-fluid rounded"></a>
                <div class="info">
                    <a href="" class="title">Chợ nổi cái răng </a>
                    <div class="star-date d-flex justify-content-between">
                        <span class="star">
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                        </span>
                        <span class="date">
                            <i class="fas fa-calendar-alt">15/09/2020</i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="item-place item">
                <a href="" title=""><img
                        src="https://kenh14cdn.com/crop/640_360/2017/201707171029208104-1500637821156-564-0-1189-1000-crop-1500638323245.jpg"
                        alt="" class="img-fluid rounded"></a>
                <div class="info">
                    <a href="" class="title">Chợ nổi cái răng nguyen hoang veng nguai gnnga gann</a>
                    <div class="star-date d-flex justify-content-between">
                        <span class="star">
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                        </span>
                        <span class="date">
                            <i class="fas fa-calendar-alt">15/09/2020</i>
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
</div>
@endsection
@section('script')
<script>
var a = '[" review-hinh-anh-ben-ninh-kieu-can-tho-ve-dem-2.jpg","cho-dem-tay-do.jpg","cau-can-tho-1-960x480.jpg"]';
console.log(JSON.parse(a)[0])
</script>
<script>
$(".owl-carousel").owlCarousel({

    autoPlay: 3000,
    items: 4,

    center: true,
    nav: true,
	loop: true,
	responsiveClass:true,

    responsive: {
        0:{
            items:1,
            nav:true
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:5,
            nav:true,
            loop:false
        }
    }
});
</script>
@endsection