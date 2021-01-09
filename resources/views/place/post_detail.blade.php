@extends('layouts.index')
@section('content')
<?php
	$image_topic = json_decode($post_review->topic->image)[0];
	
?>
<div id="content">
    <div class="overview-place" id="forum">
        <div class="post bk-img overlay" style="background-image: url('image/image_place/{{$image_topic}}')">
            <div class="container ">
                <div class="row">
                    <div class="col-md-12 banner-title text-center">
                        <a href="{{url('topic')}}/{{$post_review->topic_id}}"
                            class="post-title mb-20 d-block">{{$post_review->topic->name}}</a>
                        <div class="info-create d-flex justify-content-center ">
                            <a href="" class="avatar"><img
                                    src="image/image_avatar/{{$post_review->topic->user->avatar}}" alt=""></a>
                            <span class="username align-self-center">{{$post_review->user->username}}</span>
                            <span class="create-date align-self-center"><i class="fas fa-calendar-alt">
                                    {{$post_review->topic->created_at->format('d-m-Y')}}</i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Chi tiet bai post -->
        <div id="detail_post_forum">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="topic-title-head d-flex">
                            <span class="topic">[Chia sẻ]</span>
                            <h2 href="?page=detail_post_forum" class="title">
                                <?php echo "_". ucwords($post_review->title) ?></h2>
                        </div>
                    </div>
                </div>

            </div>

            <div class="container detail">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="row p-broder">
                            <div class="col-lg-2 col-md-12 avatar-center">
                                <div class="image-avatar"><a href="" class="avatar d-block"><img
                                            src="image/image_avatar/{{$post_review->user->avatar}}" alt=""></a></div>
                                <div class="username">
                                    <h1>{{$post_review->user->username}}</h1>
                                </div>
                            </div>
                            <div class="col-lg-10 col-md-12 post-content">
                                <div class="date">{{$post_review->created_at->format('d-m-Y')}}</div>
                                <!-- Noi dung -->
                                {!!$post_review->content!!}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="row p-broder">
                            <div class="col-12">
                                <div class="title-new">
                                    <h1>Bài viết liên quan</h1>
                                </div>
                                @if(count($post_new) > 0)
                                <ul class="list-post mb-2">
                                    @foreach($post_new as $post)
                                    <li class="d-flex">
                                        <a href="" class="avatar d-block mr-3"><img
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
											{{$post->created_at->format('d-m-Y')}}
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                                @else
                                <div class="alert alert-default-success">Chưa có nhiều chia sẻ về địa điểm này</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <!-- form comment -->
        <div class="back-to-top form-comment">
            <i class="fas fa-arrow-alt-circle-up"></i>
        </div>
       
    </div>
</div>
</div>
<!-- XU LÝ HIỂN THỊ CÁC ĐỊA ĐIỂM GẦN LÊN BẢN ĐỒ -->

@endsection
@section('script')
<script type="text/javascript">
    $(window).scroll(function(){
        if($(window).scrollTop() >=100){
           
            $(".back-to-top").fadeIn(500);
        }else{
            $(".back-to-top").fadeOut(500);  
        }
    });
    $(".back-to-top").click(function(){
        $("html,body").animate({scrollTop:0},100);
    })
</script>
@endsection