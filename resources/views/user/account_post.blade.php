@extends('layouts.index')
@section('content')
<div id="content">
    <div id="profile-user">
        <div class="cover-image">

            <img class="img_cover{{$user->id}}" src="image/image_cover/{{$user->img_cover}}" alt="">

            <div class="container position-avatar">
                <div class="container avatar-username">
                    <div class="row">
                        <div class="col-12  d-flex justify-content-center">
                            <div class="v">
                                <div class="border-avatar">
                                    <a href="" class="avatar "><img class="avatar{{$user->id}}"
                                            src="image/image_avatar/{{$user->avatar}}" alt=""></a>
                                </div>
                                <div class="username">
                                    <h1>{{$user->username}}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container action-setting bg-padding">
            <div class="row introduce d-block d-lg-none">
                <div class="col-md-12">
                    <h1>Gioi Thieu</h1>
                    <div class="address">
                        <span><i class="fas fa-map-marker-alt mr-3"></i>Can Tho,Viet Nam</span>
                    </div>
                    <div class="time-join"><span><i class="fas fa-calendar-alt mr-3"></i>Da tham gia 15/09/2020</span>
                    </div>
                </div>
            </div>
            <div class="row menu-profile">
                <div class="col-lg-8 col-md-12 menu">
                    <ul class="d-flex btn ">
                        <li><a href="{{url('user')}}/{{$user->id}}/info">Dòng thời gian</a></li>
                        
                        <li><a href="{{url('user')}}/{{$user->id}}/info/friends">Bạn bè</a></li>

                    </ul>
                </div>

            </div>
        </div>
        <div class="container action-show mt-3">
            <div class="row">
                <!-- dgs -->
                <div class="col-lg-3 d-none d-md-block">
                    <div class="row bg-padding">
                        <div class="introduce">
                            <div class="col-lg-12">
                                <h1>Gioi Thieu</h1>
                                <div class="address">
                                    <span><i class="fas fa-map-marker-alt mr-3"></i>Can Tho,Viet Nam</span>
                                </div>
                                <div class="time-join"><span><i class="fas fa-calendar-alt mr-3"></i>Da tham gia
                                        15/09/2020</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="row bg-padding mt-3">
                        <div class="introduce">
                            <div class="col-lg-12">
                                <h1>Chia sẻ các điểm du lịch</h1>
                                <div class="address">
                                    <span><i class="fas fa-map-marker-alt mr-3"></i>Can Tho,Viet Nam</span>
                                </div>
                                <div class="time-join"><span><i class="fas fa-calendar-alt mr-3"></i>Da tham gia
                                        15/09/2020</span></div>
                            </div>
                        </div>
                    </div>



                </div>
                <div class="col-lg-6 col-md-12 diary rating-comment mt-0">
                    <!-- Tao bai viet -->
                    <div class="row p-responsive">
                        <!-- Danh sach cac bai viet -->
                        @foreach($posts as $post)
                        <div class="row p-responsive mb-4 w-100" id='post-share-id-{{$post->id}}'>
                            <div class="bg-white pt-pb-15 w-100">
                                <div class="col-12 info-user d-flex mb-2">
                                    <a href="" class="avatar d-block"><img
                                            src="image/image_avatar/{{$post->user->avatar}}" alt=""></a>
                                    <div class="username-time ml-3 d-flex justify-content-between w-100">
                                        <div class="info-desc">
                                            <p>
                                                <span class="title">{{$post->user->username}}</span>
                                                @if(!is_null($post->address))
                                                <span class="location"><span>Đang ở
                                                    </span><span class="">{{$post->address}}</span></span>
                                                @endif

                                            </p>
                                            <p style="font-size:13px;margin-top:2px"><span
                                                    class="time mt-1">{{Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</span>
                                            </p>

                                        </div>

                                    </div>

                                </div>
                                <div class="col-12 info-content">
                                    <div class="post-text">
                                        <p>{{$post->content}}</p>
                                    </div>
                                    <!-- Hinh anh co trong bai post -->
                                    <?php $num_img = count($post->images)?>
                                    @if($num_img > 0)
                                    <div class="row review-image">
                                        <?php $i=0?>
                                        @foreach($post->images as $img)
                                        <?php $i++?>
                                        @if($i<=3) <div class="col-sm-6 col-md-6 thumb">
                                            <img src="upload/image_post/{{$img->filename}}" class="img-fluid mb-2 w-100"
                                                alt="white sample" data-toggle="modal"
                                                data-target="#modalReviewImagePostShare{{$post->id}}" />
                                    </div>

                                    @endif
                                    @if($i == 4)
                                    <div class="col-sm-6 col-md-6 thumb thumb-relative">
                                        <img src="upload/image_post/{{$img->filename}}" alt="">
                                        <div class="overlayy" data-toggle="modal"
                                            data-target="#modalReviewImagePostShare{{$post->id}}">
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
                                @foreach($post->comments as $comment)
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
                                    <input type="hidden" class="post-share" value="{{$post->id}}">
                                </div>

                            </div>

                        </div>

                    </div>

                    @endforeach
                    <!-- Modal review image post share -->
                    @foreach($posts as $post)
                    <?php $num_img = count($post->images)?>
                    @if($num_img > 0)
                    <div id="modalReviewImagePostShare{{$post->id}}" class="modal">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-content">
                                    <div class="mainThumbReviewImg">
                                        <img src="upload/image_post/{{$post->images[0]->filename}}" alt="" />
                                    </div>
                                    <div class="owl-carousel">
                                        @foreach($post->images as $img)
                                        <div class="item"> <img src="upload/image_post/{{$img->filename}}"
                                                alt="image" /> </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>

            </div>
        </div>
    </div>

</div>

</div>
@endsection
@section('script')
<script>
// 2. Binh luan post share
var user_id = "{{Auth::user()->id}}";
var socket = io('http://localhost:6001');
socket.on('laravel_database_comment_post_share:comment_post_share', function(data) {
    if (user_id != data.data_comment.user_id) {
        $('#post-share-id-' + data.data_comment.post_share_id + ' .card-comments').append(data
            .data_comment
            .html);
    }
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