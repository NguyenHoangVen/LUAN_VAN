@extends('layouts.index')
@section('content')

<div id="content">

    <div class="container" id="team">
        <div class="row pt-4">
            <div class="col-lg-6" id="forum">
                <div class="category">
                    <h2>Bài viết mới nhất</h2>
                </div>
               
                <ul class="list-post mb-2 scroll-sidebar-group">
                    @foreach($post_reviews as $post)
                    <li class="d-flex pr-2 post-review-{{$post->id}}" target="_blank">
                        <a href="#" class="avatar d-block mr-3"><img class="img-50"
                                src="image/image_avatar/{{$post->user->avatar}}" alt="" ></a>
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
                       
                        
                    </li>
                    @endforeach

                </ul>
            </div>
            <div class="col-lg-6 col-md-12 scroll-sidebar-group">
                <div class="central-meta postbox">
                    <span class="create-post">Tạo bài viết</span>
                    <div class="new-postbox">
                        <div class="avatar d-block float-left"><img
                                src="image/image_avatar/{{Auth::user()->avatar}}"
                                alt=""></div>
                        <div class="newpst-input">
                            <!-- <form method="post"> -->
                            <textarea rows="2" data-toggle="modal" data-target="#modalCreatPostShare"
                                placeholder="Hôm nay bạn thế nào ?"></textarea>
                            <!-- </form> -->
                        </div>
                    </div>
                </div>
                <!-- Danh sach cac bao chia se trong team -->
                <div class="share-post">
                    @if(count($post_shares) > 0)
                    @foreach($post_shares as $post_share)
                    <div class="col-12 diary mt-0" id='post-share-id-{{$post_share->id}}'>
                        <div class="row mb-4">
                            <div class="bg-white pt-pb-15 w-100">

                                <div class="col-12 info-user d-flex mb-2">
                                    <a href="" class="avatar d-block ">
                                        <img src="image/image_avatar/{{$post_share->user->avatar}}" alt="">
                                    </a>
                                    <div class="username-time ml-3 d-flex justify-content-between w-100">
                                        <div class="info-desc">
                                            <p>
                                                <span class="title">{{$post_share->user->username}}</span>
                                                @if(!is_null($post_share->address))
                                                <span class="location"><span>Đang ở
                                                    </span><span class="">{{$post_share->address}}</span></span>
                                                @endif

                                            </p>
                                            <p><span
                                                    class="time mt-1">{{Carbon\Carbon::parse($post_share->created_at)->diffForHumans()}}</span>
                                            </p>

                                        </div>

                                        @if(userCreatePostShare($post_share->id,Auth::user()->id))
                                        <div class="report-follow dropdown dropleft"><i class="fas fa-ellipsis-h"
                                                data-toggle="dropdown"></i>
                                            <div class="dropdown-menu ">
                                                <a href="team/delete-post-share/{{$post_share->id}}"
                                                    class="dropdown-item delete-post-share"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa không?');">Xóa
                                                    bài viết</a>
                                                <a href="" class="dropdown-item edit-post-share" data-toggle="modal"
                                                    data-target="#modalUpdatePostShare">Chỉnh
                                                    sửa
                                                    <input type="hidden" class="post-share-id"
                                                        value="{{$post_share->id}}">
                                                </a>
                                            </div>
                                        </div>
                                        @endif
                                    </div>

                                </div>
                                <div class="col-12 info-content">
                                    <div class="post-text">
                                        <p>{{$post_share->content}}</p>
                                    </div>
                                    <!-- Hinh anh co trong bai post -->
                                    <?php $num_img = count($post_share->images)?>
                                    @if($num_img > 0)
                                    <div class="row review-image">
                                        <?php $i=0?>
                                        @foreach($post_share->images as $img)
                                        <?php $i++?>
                                        @if($i<=3) <div class="col-sm-6 col-md-6 thumb">


                                            <img src="upload/image_post/{{$img->filename}}" class="img-fluid mb-2 w-100"
                                                alt="white sample" data-toggle="modal"
                                                data-target="#modalReviewImagePostShare{{$post_share->id}}" />

                                    </div>
                                    @endif
                                    @if($i == 4)
                                    <div class="col-sm-6 col-md-6 thumb thumb-relative">
                                        <img src="upload/image_post/{{$img->filename}}" alt="">
                                        <div class="overlayy">
                                            <div class="number"><span>+
                                                    {{$num_img-4}}</span></div>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                                @endif
                            </div>
                            <div class="card-footer card-comments bg-white mt-2">
                                @foreach($post_share->comments as $comment)
                                <div class="card-comment">
                                    <!-- User image -->
                                    <img class="img-circle img-sm" src="image/image_avatar/{{$comment->user->avatar}}"
                                        alt="User Image">

                                    <div class="comment-text">
                                        <span class="username">
                                            {{$comment->user->username}}
                                            <span class="text-muted float-right">
                                                {{Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}
                                            </span>
                                        </span><!-- /.username -->
                                        {{$comment->content}}
                                    </div>
                                    <!-- /.comment-text -->
                                </div>
                                @endforeach

                            </div>
                            <div class="card-footer bg-white">

                                <img class="img-fluid img-circle img-sm"
                                    src="image/image_avatar/{{Auth::user()->avatar}}" alt="Alt Text">
                                <!-- .img-push is used to add margin to elements next to floating images -->
                                <div class="img-push">
                                    <input type="text" class="form-control form-control-sm input-coment-post-share"
                                        placeholder="Viết bình luận...">
                                    <input type="hidden" class="post-share" value="{{$post_share->id}}">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                @endforeach
                @endif


            </div>


        </div>
        
    </div>
    <!-- Modal review image post share -->
    @foreach($post_shares as $post_share)
    <?php $num_img = count($post_share->images)?>
    @if($num_img > 0)
    <div id="modalReviewImagePostShare{{$post_share->id}}" class="modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-content">
                    <div class="mainThumbReviewImg">
                        <img src="upload/image_post/{{$post_share->images[0]->filename}}" alt="" />
                    </div>
                    <div class="owl-carousel">
                        @foreach($post_share->images as $img)
                        <div class="item"> <img src="upload/image_post/{{$img->filename}}" alt="image" /> </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endforeach
    <!-- .ket thuc modal image post share -->
    <!-- Modal Cap nhat lai bai post share trong nhom -->
    <div class="modal fade" id="modalUpdatePostShare">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Chỉnh sửa bài viết của bạn</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form id="form-update-post-share" enctype="multipart/form-data" action="team/update-post-share"
                        method="post">
                        @csrf
                        <div class="row">
                          


                            <div class="content-post-share col-12">
                                <!-- Image review -->
                            </div>
                            <div class="attachments col-12">
                                <ul>
                                    <li>
                                        <span class="add-loc">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </span>
                                    </li>
                                    
                                    <li>
                                        <i class="fa fa-image"></i>
                                        <label class="fileContainer">

                                            <input type="file" class="custom-file-input" multiple=""
                                                id="uploadImgPostShare" name="image[]">
                                            <div class="icon-image"></div>
                                            <!-- image delete -->
                                            <div id="file_hidden1"></div>
                                            <input type="hidden" id="file_name_image_delete1" name="file_delete">

                                        </label>
                                    </li>
                                </ul>

                            </div>

                            <div class="col-12 wp-input-location-share d-none">
                                <div class="input-group mt-1 ">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-secondary button-location-share1"
                                            type="button">Tại:</button>
                                    </div>
                                    <input type="text" class="form-control locationInPostShare1"
                                        placeholder="Bạn đang ở đâu?">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-none alert alert-default-primary w-100 mb-1 mt-2">
                                    Cập nhật
                                    thành công!</div>
                            </div>
                            <div class="col-12 mt-2 regime d-flex">
                                <button type="button" class="btn btn-danger mr-auto" data-dismiss="modal">Hủy</button>
                                <select class="form-control" name="status">
                                    <option value="0">Công khai</option>
                                    <option value="1">Chỉ trong nhóm</option>
                                </select>
                                <button class="btn btn-success">Lưu</button>


                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- ./ ket thuc Modal Cap nhat lai bai post share trong nhom -->
     <!-- Modal create post share -->
    <div class="modal fade" id="modalCreatPostShare">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tạo bài viết</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form id="form-post-share" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="info-user d-flex">
                                    <div class="avatar d-block mr-3">
                                        <img class="img-50"
                                            src="image/image_avatar/1542276278-405-kieu-trinh-3-1542275166-width650height433.jpg"
                                            alt="">
                                    </div>
                                    <div class="info-desc">
                                        <p>
                                            <span class="title">Hoang Ven</span>
                                            <span class="location"></span>
                                        </p>

                                    </div>

                                </div>
                            </div>
                            <div class="col-12">
                                <input type="hidden" name="checkin_location" class="checkin-location">
                                <textarea name="content" class="content" class="w-100" rows="5"
                                    placeholder="Hôm nay bạn thế nào..."></textarea>
                            </div>
                            <!-- Image review -->
                            <div class="col-12 mt-2">

                                <div class="row">
                                    <div id="reviewimg">
                                        <input type="hidden" name="numselect" class="numselect" value="1">
                                        <input type="hidden" name="numdelete" class="numdelete" value="1">
                                    </div>
                                </div>
                            </div>
                            <div class="attachments col-12">
                                <ul>
                                    <li>
                                        <span class="add-loc">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </span>
                                    </li>
                                    <li>
                                        <i class="fa fa-music"></i>
                                        <label class="fileContainer">
                                            <input type="file">
                                        </label>
                                    </li>
                                    <li>
                                        <i class="fa fa-image"></i>
                                        <label class="fileContainer">

                                            <input type="file" class="custom-file-input" multiple=""
                                                id="uploadImgAddTopic" name="image[]">
                                            <div class="icon-image"></div>
                                            <!-- image delete -->
                                            <div id="file_hidden"></div>
                                            <input type="hidden" id="file_name_image_delete" name="file_delete">
                                            <input type="hidden" name='team_id' value="">
                                        </label>
                                    </li>
                                </ul>

                            </div>

                            <div class="col-12 wp-input-location-share d-none">
                                <div class="input-group mt-1 ">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-secondary button-location-share"
                                            type="button">Tại:</button>
                                    </div>
                                    <input type="text" class="form-control locationInPostShare"
                                        placeholder="Bạn đang ở đâu?">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-none alert alert-default-primary w-100 mb-1 mt-2">
                                    Đăng bài
                                    thành công!</div>
                            </div>
                            <div class="col-12 mt-2 regime d-flex flex-row-reverse">
                                <button class="btn btn-success">Đăng</button>
                                <select class="form-control" name="status">
                                    <option value="0">Công khai</option>
                                    <option value="2">Chỉ mình tôi</option>
                                </select>


                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="js/uploadfile.js"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAooDY7d6iFESb-veaQGNNeSVrb_isnJUI&libraries=places&callback=initMap"
    defer>
</script>


<script>
// 2. Binh luan post share
var user_id = "{{Auth::user()->id}}";
var socket = io('http://localhost:6001');
socket.on('laravel_database_comment_post_share:comment_post_share', function(data) {
    if (user_id != data.data_comment.user_id) {
        $('#post-share-id-' + data.data_comment.post_share_id + ' .card-comments').append(data.data_comment
            .html);
    }
})
// Map lay dia diem check in
function initMap() {
    // =======Tao bai viet, status, dong thoi gian,Checkin======
    var geocoder = new google.maps.Geocoder();
    var input_location_share = document.getElementsByClassName("locationInPostShare")[0];
    var autoComplateShare = new google.maps.places.Autocomplete(input_location_share);
    autoComplateShare.setFields(["place_id", "geometry", "name", "formatted_address"]);
    autoComplateShare.addListener('place_changed', () => {
        var place = autoComplateShare.getPlace();
        var place_id = place.place_id;
        console.log(place);
        var html = '<span>Đang ở </span>' +
            '<span class="title"> ' + place.formatted_address + '</span>';
        $('#form-post-share .info-desc .location').html(html);
        $('#form-post-share .checkin-location').val(place.formatted_address);

    })
    var locationButtonShare = document.getElementsByClassName("button-location-share")[0];
    // Su kien click ay vi tri hien tai
    locationButtonShare.addEventListener("click", () => {

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    // console.log(position)
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };
                    // Lay vi tri nguoc
                    geocoder.geocode({
                        location: pos
                    }, (results, status) => {
                        // console.log(results)
                        if (status === "OK") {
                            if (results[0]) {
                                var html = '<span>Đang ở </span>' +
                                    '<span class="title"> ' + results[0].formatted_address +
                                    '</span>';
                                $('#form-post-share .info-desc .location').html(html);
                                $('#form-post-share .checkin-location').val(results[0]
                                    .formatted_address);
                            } else {
                                window.alert("No results found");
                            }
                        } else {
                            window.alert("Geocoder failed due to: " + status);
                        }
                    });
                }, () => {
                    handleLocationError(true, infoWindow, mapRoute.getCenter());
                }
            );
        } else {

            handleLocationError(false, infoWindow, map.getCenter());
        }
    });
    // ===========CAP NHAT BAI VIET===========
    // =======Tao bai viet, status, dong thoi gian,Checkin======

    var input_location_share1 = document.getElementsByClassName("locationInPostShare1")[0];
    var autoComplateShare1 = new google.maps.places.Autocomplete(input_location_share1);
    autoComplateShare1.setFields(["place_id", "geometry", "name", "formatted_address"]);
    autoComplateShare1.addListener('place_changed', () => {
        var place = autoComplateShare1.getPlace();
        var place_id = place.place_id;
        console.log(place);
        var html = '<span>Đang ở </span>' +
            '<span class="title"> ' + place.formatted_address + '</span>';
        $('#form-update-post-share .info-desc .location').html(html);
        $('#form-update-post-share .checkin-location').val(place.formatted_address);

    })
    var locationButtonShare1 = document.getElementsByClassName("button-location-share1")[0];
    // Su kien click ay vi tri hien tai
    locationButtonShare1.addEventListener("click", () => {

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    // console.log(position)
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };
                    // Lay vi tri nguoc
                    geocoder.geocode({
                        location: pos
                    }, (results, status) => {
                        // console.log(results)
                        if (status === "OK") {
                            if (results[0]) {
                                var html = '<span>Đang ở </span>' +
                                    '<span class="title"> ' + results[0].formatted_address +
                                    '</span>';
                                $('#form-update-post-share .info-desc .location').html(html);
                                $('#form-update-post-share .checkin-location').val(results[0]
                                    .formatted_address);
                            } else {
                                window.alert("No results found");
                            }
                        } else {
                            window.alert("Geocoder failed due to: " + status);
                        }
                    });
                }, () => {
                    handleLocationError(true, infoWindow, mapRoute.getCenter());
                }
            );
        } else {

            handleLocationError(false, infoWindow, map.getCenter());
        }
    });

}
// === Show input location in check in share post==
$('#form-post-share .fa-map-marker-alt,#form-update-post-share .fa-map-marker-alt').click(function() {
    $('.wp-input-location-share').toggleClass('d-none');
})
$(".owl-carousel").owlCarousel({

    // autoPlay: 3000,
    items: 4,
    itemsDesktop: [1199, 3],
    itemsDesktopSmall: [979, 3],
    center: true,
    nav: true,
    loop: true,

    responsive: {
        600: {
            items: 4
        }
    }
});
</script>
@endsection