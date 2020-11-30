@extends('layouts.index')
@section('content')

<div id="content">

    <div class="container" id="team-detail">

        <div class="callout callout-info mt-2">
            <div class="row">
                <div class="col-lg-10 col-md-12 p-3 text-left">
                    <h1 style="font-weight:bold;font-size:1rem">{{$team->title}}</h1>
                </div>
                <div class="col-lg-2 col-md-12 text-left text-lg-right">
                    @if(isMemberTeam(Auth::user()->id,$team->id))
                    <div class="btn btn-success">Thanh vien</div>
                    @else
                    <div class="btn btn-success" data-toggle="modal" data-target="#join-team"><i
                            class="fas fa-plus"></i>Tham gia nhóm</div>
                    @endif
                </div>
            </div>
        </div>
        <!--  -->

        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link " id="custom-tabs-chat-room" data-toggle="pill" href="#chat-room"
                                    role="tab" aria-controls="custom-tabs-four-home" aria-selected="false">Chat</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " id="custom-tabs-four-profile-tab" data-toggle="pill"
                                    href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                                    aria-selected="false">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-post-share-team" data-toggle="pill"
                                    href="#post-share" role="tab" aria-controls="custom-tabs-four-settings"
                                    aria-selected="true">Bài chia sẻ
                                </a>
                            </li>
                            <!-- Thanh vien  -->
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-member-team" data-toggle="pill" href="#member-team"
                                    role="tab" aria-controls="custom-tabs-four-settings" aria-selected="true">Thành viên
                                </a>
                            </li>
                            <!-- neu thanh vien moi dc xem thong tin ca nhan -->
                            @if(isMemberTeam(Auth::user()->id,$team->id))
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-info-profile-member" data-toggle="pill"
                                    href="#info-profile-member" role="tab" aria-controls="custom-tabs-four-profile"
                                    aria-selected="false">Thông tin cá nhân

                                    @if(checkLeader(Auth::user()->id,$team->id))
                                    <span title="3 New Messages" class="badge bg-danger">!</span>
                                    @endif
                                </a>
                            </li>
                            @endif
                            <!-- Ke hoach -->
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-plan" data-toggle="pill" href="#plan" role="tab"
                                    aria-controls="custom-tabs-four-settings" aria-selected="true">Kế hoạch

                                </a>
                            </li>
                            <!-- Thong tin chuyen di -->
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-info-trip" data-toggle="pill" href="#info-trip"
                                    role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Chuyến
                                    đi
                                    @if(infoTeamEmpty($team->id))
                                    <span title="3 New Messages" class="badge bg-danger">!</span>
                                    @endif
                                </a>
                            </li>
                            <!-- Ban do lo trinh -->
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-map-route" data-toggle="pill" href="#map-route"
                                    role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Bản đồ lộ
                                    trình</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body bg-light">
                        <div class="tab-content" id="custom-tabs-four-tabContent">
                            <!-- Chat Room -->
                            <div class="tab-pane fade" id="chat-room" role="tabpanel"
                                aria-labelledby="custom-tabs-four-home-tab">

                            </div>
                            <!-- Profile -->
                            <div class="tab-pane fade " id="custom-tabs-four-profile" role="tabpanel"
                                aria-labelledby="custom-tabs-four-profile-tab">
                                Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus
                                ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur
                                adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices
                                posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula
                                placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet
                                ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
                            </div>

                            <!-- Thanh Vien -->
                            <div class="tab-pane fade" id="member-team" role="tabpanel"
                                aria-labelledby="custom-tabs-four-settings-tab">


                            </div>
                            <!-- Bai viet chai se len nhom -->
                            <div class="tab-pane fade active show" id="post-share" role="tabpanel"
                                aria-labelledby="custom-tabs-four-profile-tab">
                                <div class="wp-post-share">

                                    <div class="row">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="central-meta postbox">
                                                <span class="create-post">Tạo bài viết</span>
                                                <div class="new-postbox">
                                                    <div class="avatar d-block float-left"><img
                                                            src="image/image_avatar/1542276278-405-kieu-trinh-3-1542275166-width650height433.jpg"
                                                            alt=""></div>
                                                    <div class="newpst-input">
                                                        <!-- <form method="post"> -->
                                                        <textarea rows="2" data-toggle="modal"
                                                            data-target="#modalCreatPostShare"
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
                                                                    <img src="image/image_avatar/{{$post_share->user->avatar}}"
                                                                        alt="">
                                                                </a>
                                                                <div
                                                                    class="username-time ml-3 d-flex justify-content-between w-100">
                                                                    <div class="info-desc">
                                                                        <p>
                                                                            <span
                                                                                class="title">{{$post_share->user->username}}</span>
                                                                            @if(!is_null($post_share->address))
                                                                            <span class="location"><span>Đang ở
                                                                                </span><span
                                                                                    class="">{{$post_share->address}}</span></span>
                                                                            @endif
                                                                        </p>

                                                                    </div>

                                                                    @if(userCreatePostShare($post_share->id,Auth::user()->id))
                                                                    <div class="report-follow dropdown dropleft"><i
                                                                            class="fas fa-ellipsis-h"
                                                                            data-toggle="dropdown"></i>
                                                                        <div class="dropdown-menu ">
                                                                            <a href="team/delete-post-share/{{$post_share->id}}"
                                                                                class="dropdown-item delete-post-share"
                                                                                onclick="return confirm('Bạn có chắc chắn muốn xóa không?');">Xóa
                                                                                bài viết</a>
                                                                            <a href=""
                                                                                class="dropdown-item edit-post-share"
                                                                                data-toggle="modal"
                                                                                data-target="#modalUpdatePostShare">Chỉnh
                                                                                sửa
                                                                                <input type="hidden"
                                                                                    class="post-share-id"
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


                                                                        <img src="upload/image_post/{{$img->filename}}"
                                                                            class="img-fluid mb-2 w-100"
                                                                            alt="white sample" data-toggle="modal"
                                                                            data-target="#modalReviewImagePostShare{{$post_share->id}}" />

                                                                </div>
                                                                @endif
                                                                @if($i == 4)
                                                                <div class="col-sm-6 col-md-6 thumb thumb-relative">
                                                                    <img src="upload/image_post/{{$img->filename}}"
                                                                        alt="">
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
                                                                <img class="img-circle img-sm"
                                                                    src="image/image_avatar/{{$comment->user->avatar}}"
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
                                                                src="image/image_avatar/{{Auth::user()->avatar}}"
                                                                alt="Alt Text">
                                                            <!-- .img-push is used to add margin to elements next to floating images -->
                                                            <div class="img-push">
                                                                <input type="text"
                                                                    class="form-control form-control-sm input-coment-post-share"
                                                                    placeholder="Viết bình luận...">
                                                                <input type="hidden" class="post-share"
                                                                    value="{{$post_share->id}}">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            @endforeach
                                            @endif
                                            <!-- Cai lam chuan -->
                                            <div class="col-12 diary mt-0">
                                                <div class="row mb-4">
                                                    <div class="bg-white pt-pb-15">

                                                        <div class="col-12 info-user d-flex mb-2">
                                                            <a href="" class="avatar d-block"><img
                                                                    src="image/image_avatar/1542276278-405-kieu-trinh-3-1542275166-width650height433.jpg"
                                                                    alt=""></a>
                                                            <div
                                                                class="username-time ml-3 d-flex justify-content-between w-100">
                                                                <div>
                                                                    <a href="" class="username">Carter Post
                                                                        Album</a>
                                                                    <span class="time">đã viết bài viêt này vào
                                                                        4/5/555</span>
                                                                </div>
                                                                <div class="report-follow dropdown dropleft"><i
                                                                        class="fas fa-ellipsis-h"
                                                                        data-toggle="dropdown"></i>
                                                                    <div class="dropdown-menu ">
                                                                        <a href="" class="dropdown-item">Báo cáo nội
                                                                            dung</a>
                                                                        <a href="" class="dropdown-item">Theo
                                                                            dõi</a>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-12 info-content">
                                                            <div class="post-text">
                                                                <p>Lorem ipsum, dolor sit amet consectetur
                                                                    adipisicing elit. Neque, tempora.</p>
                                                                <p>Lorem ipsum dolor sit amet consectetur
                                                                    adipisicing elit. Suscipit, aspernatur!</p>
                                                            </div>
                                                            <div class="row review-image">
                                                                <div class="col-sm-6 col-md-6 thumb">
                                                                    <img src="image/image_avatar/images.jpg" alt="">
                                                                </div>
                                                                <div class="col-sm-6 col-md-6 thumb">
                                                                    <img src="image/image_avatar/images.jpg" alt="">
                                                                </div>
                                                                <div class="col-sm-6 col-md-6 thumb">
                                                                    <img src="image/image_avatar/images.jpg" alt="">
                                                                </div>
                                                                <div class="col-sm-6 col-md-6 thumb thumb-relative">
                                                                    <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1a/6f/e6/7c/r-t-trong.jpg?w=400&amp;h=200&amp;s=1"
                                                                        alt="">
                                                                    <div class="overlayy">
                                                                        <div class="number"><span>+ 4</span></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer card-comments bg-white mt-2">
                                                            <div class="card-comment">
                                                                <!-- User image -->
                                                                <img class="img-circle img-sm"
                                                                    src="image/image_avatar/{{Auth::user()->avatar}}"
                                                                    alt="User Image">

                                                                <div class="comment-text">
                                                                    <span class="username">
                                                                        Maria Gonzales
                                                                        <span class="text-muted float-right">8:03 PM
                                                                            Today</span>
                                                                    </span><!-- /.username -->
                                                                    It is a long established fact that a reader will
                                                                    be distracted
                                                                    by the readable content of a page when looking
                                                                    at its layout.
                                                                </div>
                                                                <!-- /.comment-text -->
                                                            </div>
                                                            <!-- /.card-comment -->
                                                            <div class="card-comment">
                                                                <!-- User image -->
                                                                <img class="img-circle img-sm"
                                                                    src="image/image_avatar/{{Auth::user()->avatar}}"
                                                                    alt="User Image">

                                                                <div class="comment-text">
                                                                    <span class="username">
                                                                        Nora Havisham
                                                                        <span class="text-muted float-right">8:03 PM
                                                                            Today</span>
                                                                    </span><!-- /.username -->
                                                                    The point of using Lorem Ipsum is that it hrs a
                                                                    morer-less
                                                                    normal distribution of letters, as opposed to
                                                                    using
                                                                    'Content here, content here', making it look
                                                                    like readable English.
                                                                </div>
                                                                <!-- /.comment-text -->
                                                            </div>
                                                            <!-- /.card-comment -->
                                                        </div>
                                                        <div class="card-footer bg-white">
                                                            <form action="#" method="post">
                                                                <img class="img-fluid img-circle img-sm"
                                                                    src="image/image_avatar/{{Auth::user()->avatar}}"
                                                                    alt="Alt Text">
                                                                <!-- .img-push is used to add margin to elements next to floating images -->
                                                                <div class="img-push">
                                                                    <input type="text"
                                                                        class="form-control form-control-sm"
                                                                        placeholder="Viết bình luận...">
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                    </div>
                                    <div class="col-lg-3"></div>
                                </div>

                            </div>
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
                                                        <input type="hidden" name="checkin_location"
                                                            class="checkin-location">
                                                        <textarea name="content" class="content" class="w-100" rows="5"
                                                            placeholder="Hôm nay bạn thế nào..."></textarea>
                                                    </div>

                                                    <!-- Image review -->
                                                    <div class="col-12 mt-2">

                                                        <div class="row">
                                                            <div id="reviewimg">
                                                                <input type="hidden" name="numselect" class="numselect"
                                                                    value="1">
                                                                <input type="hidden" name="numdelete" class="numdelete"
                                                                    value="1">
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

                                                                    <input type="file" class="custom-file-input"
                                                                        multiple="" id="uploadImgAddTopic"
                                                                        name="image[]">
                                                                    <div class="icon-image"></div>
                                                                    <!-- image delete -->
                                                                    <div id="file_hidden"></div>
                                                                    <input type="hidden" id="file_name_image_delete"
                                                                        name="file_delete">
                                                                    <input type="hidden" name='team_id'
                                                                        value="{{$team->id}}">
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
                                                            <option value="1">Chỉ trong nhóm</option>
                                                        </select>


                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                            <form id="form-update-post-share" enctype="multipart/form-data"
                                                action="team/update-post-share" method="post">
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
                                                                <i class="fa fa-music"></i>
                                                                <label class="fileContainer">
                                                                    <input type="file">
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <i class="fa fa-image"></i>
                                                                <label class="fileContainer">

                                                                    <input type="file" class="custom-file-input"
                                                                        multiple="" id="uploadImgPostShare"
                                                                        name="image[]">
                                                                    <div class="icon-image"></div>
                                                                    <!-- image delete -->
                                                                    <div id="file_hidden1"></div>
                                                                    <input type="hidden" id="file_name_image_delete1"
                                                                        name="file_delete">
                                                                    <input type="hidden" name='team_id'
                                                                        value="{{$team->id}}">
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
                                                        <button type="button" class="btn btn-danger mr-auto"
                                                            data-dismiss="modal">Hủy</button>
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
                                                <img src="upload/image_post/{{$post_share->images[0]->filename}}"
                                                    alt="" />
                                            </div>
                                            <div class="owl-carousel">
                                                @foreach($post_share->images as $img)
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
                            <!-- .ket thuc modal image post share -->

                        </div>



                        <!-- Thong tin ca nhan -->
                        <div class="tab-pane fade" id="info-profile-member" role="tabpanel"
                            aria-labelledby="custom-tabs-four-profile-tab">

                        </div>
                        <!-- Ke hoach di phuot -->
                        <div class="tab-pane fade" id="plan" role="tabpanel"
                            aria-labelledby="custom-tabs-four-profile-tab">
                        </div>
                        <!-- Thong tin ve chuyen di -->
                        <div class="tab-pane fade" id="info-trip" role="tabpanel"
                            aria-labelledby="custom-tabs-four-profile-tab">
                            <div class="wp-info-trip">
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-6 col-md-6">
                                        <h1 style="font-size:1rem;font-weight:bold;border-bottom:2px solid #b3b3b3"
                                            class="p-2 mb-3">Thông tin về chuyến đi</h1>
                                        @if(infoTeamEmpty($team->id))
                                        @if(isLeader(Auth::user()->id,$team->id))
                                        <div class="alert alert-danger">Bạn cần cập nhật thông tin về chuyến đi
                                            đầy
                                            đủ.
                                        </div>
                                        @else
                                        <div class="alert alert-danger">Nhóm trưởng chưa cập nhật đầy đủ thông
                                            tin
                                            cho
                                            chuyến đi.
                                        </div>
                                        @endif
                                        @endif

                                    </div>
                                    <div class="col-lg-3"></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-6 col-md-12">
                                        @if(isLeader(Auth::user()->id,$team->id))
                                        <form action="" id="form-update-info-trip-team">

                                            <div class="form-group">
                                                <label for="username">Tiêu đề nhóm (Chuyến đi):</label>
                                                <p class="form-error" id="error-title-trip"></p>
                                                <input type="text" class="form-control title-trip" name="title_trip"
                                                    value="{{$team->title}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="fullname">Địa điểm đi:</label>
                                                <p class="form-error" id="error-place-start"></p>
                                                <input type="text" class="form-control place-start" id="placeStart"
                                                    name="place_start" value="{{$team->start_place}}">
                                            </div>

                                            <div class="form-group">
                                                <label for="fullname">Địa điểm đến:</label>
                                                <p class="form-error" id="error-place-end"></p>
                                                <input type="text" class="form-control place-end" id="placeEnd"
                                                    name="place_end" value="{{$team->end_place}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="fullname">Ngày đi:</label>
                                                <p class="form-error" id="error-start-day"></p>
                                                @if(!is_null($team->end_day))
                                                <input type="date" class="form-control start-day" name="start_day"
                                                    value="{{Carbon\Carbon::parse($team->start_day)->format('Y-m-d')}}">
                                                @else
                                                <input type="date" class="form-control start-day" name="start_day"
                                                    value="">
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="fullname">Ngày đến:</label>
                                                <p class="form-error" id="error-end-day"></p>
                                                @if(!is_null($team->end_day))
                                                <input type="date" class="form-control end-day" name="end_day"
                                                    value="{{Carbon\Carbon::parse($team->end_day)->format('Y-m-d')}}">
                                                @else
                                                <input type="date" class="form-control end-day" name="end_day" value="">
                                                @endif
                                            </div>
                                            <!-- input hidden -->
                                            <input type="hidden" id="id_place_start" name="placeIdStart"
                                                placeholder="place id start">
                                            <input type="hidden" id="id_place_end" name="placeIdEnd"
                                                placeholder="place id end">
                                            <input type="hidden" name="team_id" value="{{$team->id}}">
                                            <div class="alert alert-default-info d-none">Cập nhật thành công
                                            </div>

                                            <div class="form-group">
                                                <input type="submit" value="Cập Nhật" class="btn btn-success">
                                            </div>


                                        </form>
                                        @else
                                        <form action="" id="form-update-info-trip-team">
                                            <div class="form-group">
                                                <label for="username">Tiêu đề nhóm (Chuyến đi):</label>
                                                <p class="form-error" id="error-title-trip"></p>
                                                <input type="text" class="form-control title-trip" name="username"
                                                    disabled="" value="{{$team->title}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="fullname">Địa điểm đi:</label>
                                                <p class="form-error" id="error-place-start"></p>
                                                <input type="text" class="form-control place-start" id="placeStart"
                                                    name="place_start" value="{{$team->start_place}}" disabled="">
                                            </div>

                                            <div class="form-group">
                                                <label for="fullname">Địa điểm đến:</label>
                                                <p class="form-error" id="error-place-end"></p>
                                                <input type="text" class="form-control place-end" id="placeEnd"
                                                    name="place_end" value="{{$team->end_place}}" disabled="">
                                            </div>
                                            <div class="form-group">
                                                <label for="fullname">Ngày đi:</label>
                                                <p class="form-error" id="error-start-day"></p>
                                                @if(!is_null($team->end_day))
                                                <input type="date" class="form-control start-day" name="start_day"
                                                    value="{{Carbon\Carbon::parse($team->start_day)->format('Y-m-d')}}"
                                                    disabled="">
                                                @else
                                                <input type="date" class="form-control start-day" name="start_day"
                                                    value="" disabled="">
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="fullname">Ngày đến:</label>
                                                <p class="form-error" id="error-end-day"></p>
                                                @if(!is_null($team->end_day))
                                                <input type="date" class="form-control end-day" name="end_day"
                                                    value="{{Carbon\Carbon::parse($team->end_day)->format('Y-m-d')}}"
                                                    disabled="">
                                                @else
                                                <input type="date" class="form-control end-day" name="end_day" value=""
                                                    disabled="">
                                                @endif
                                            </div>

                                        </form>
                                        @endif

                                    </div>
                                    <div class="col-lg-3"></div>
                                </div>
                                <div class="row">
                                    <div id="mapInfoTrip" style="width:100%;height:300px"></div>
                                </div>
                                <!-- 1 -->
                                <div class="card collapsed-card">
                                    <div class="card-header bg-light">
                                        <h3 class="card-title">Kế hoạch, lộ trình</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body" style="display: none;">
                                        <button type="button" class="btn btn-default btn-sm" data-toggle="modal"
                                            data-target="#editTeam"><i class="fas fa-edit"></i> Chỉnh
                                            sửa</button>
                                        <div class="alert alert-warning mt-2">Bạn cần cập nhật kế hoạch cho
                                            chuyên
                                            đi
                                        </div>

                                    </div>

                                </div>
                                <!-- 2 -->
                            </div>
                        </div>
                        <!-- Ban do lo trinh chuyen di -->
                        <div class="tab-pane fade" id="map-route" role="tabpanel"
                            aria-labelledby="custom-tabs-four-profile-tab">
                            <div id="wp-map-route">
                                <div class="row">
                                    <div class="col-lg-8 col-sm-12">
                                        <input type="text" id="input-start-route" class="form-control mt-1 ml-1 w-50">
                                        <button class="custom-map-control-button" id="button-location"
                                            style="top:-6px;left:365px"><i class="fas fa-map-marker-alt"></i></button>
                                        <div id="mapRoute" style="height:550px" class="bg-primary"
                                            placeholder="Nhập vào vị trí của bạn..."></div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="alert tutorial-direction">Hướng dẫn đường đi</div>
                                        <!-- Tra ve ket qua chi duong -->
                                        <div id="result_derection">
                                            <div class="item mt-1">
                                                <div class="btn btn-info w-100" data-toggle="collapse"
                                                    data-target="#street0" aria-expanded="true">Mậu Thân(2,1 km)
                                                </div>
                                                <div id="street" class=" text-left collapse show" style="">
                                                    <h5 class="distance">Thời gian: 6 phút</h5>
                                                    <h5 class="start_address">Từ: Khu II, Đ. 3/2, Xuân Khánh,
                                                        Ninh
                                                        Kiều, Cần Thơ, Việt Nam</h5>
                                                    <h5 class="end_address">Đến: 84 Mậu Thân, An Hoà, Ninh Kiều,
                                                        Cần
                                                        Thơ, Việt Nam</h5>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!--  -->

        </div>
    </div>

</div>

</div>

<!-- MODAL JOINTEAM -->
<div id="join-team" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thông tin tham gia nhóm</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="" id="form-join-team">
                    <div class="form-group">
                        <label for="email">Họ và tên (<span class="text-danger">*</span>)</label>
                        <p class="form-error" id="error-fullname"></p>
                        <input type="text" class="fullname form-control" placeholder="Nhập họ tên đầy đủ của bạn...">

                    </div>

                    <div class="form-group">
                        <label for="email">Số điện thoại (<span class="text-danger">*</span>)</label>
                        <p class="form-error" id="error-phone"></p>
                        <input type="number" class="phone form-control" placeholder="Nhập số điện thoại liên lạc...">

                    </div>
                    <div class="alert alert-default-info d-none">Chúc mừng bạn đã tham gia nhóm</div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success w-100" value="Tham gia">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- == MODAL CAP NHAT NOI DUNG, KE HOACH TREN NHOM ==== -->
<div id="editTeam" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Chỉnh sửa Team phượt</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="" id="form-update-team">
                    <div class="form-group">
                        <label for="email">Tiêu cho nhóm của bạn (<span class="text-danger">*</span>)</label>
                        <p class="form-error" id="error-title"></p>
                        <input type="text" class="title-team form-control">

                    </div>
                    <div class="form-group">
                        <label for="content">Nội dung</label>
                        <p class="form-error" id="error-content"></p>
                        <textarea name="" id="content-team" class="summernote content" cols="30" rows="10"></textarea>
                    </div>
                    <div class="alert alert-default-info d-none">Cập nhật thành công</div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success w-100" value="Cập nhật">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- ========================================================================================== -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ========================================================================================== -->
@section('script')
<script src="js/uploadfile.js"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAooDY7d6iFESb-veaQGNNeSVrb_isnJUI&libraries=places&callback=initMap"
    defer>
</script>
<script>
var team_id = "{{$team->id}}";
var id_place_place_end = "{{$team->id_place_end}}";
var user_id = "{{Auth::user()->id}}";
// =====================================================================
// =============== PHAN CAP NHAT THONG TIN CHUYEN DI =================
// =====================================================================
function initMap() {
    // 1. Lay thong tin dia diem cho chuyen di
    var location = {
        lat: 10.036200,
        lng: 105.788033
    };
    var mapInfoTrip = new google.maps.Map(document.getElementById('mapInfoTrip'), {
        mapTypeControl: false,
        center: location,
        zoom: 13

    });
    var input_start = document.getElementById("placeStart");
    var autocompleteStart = new google.maps.places.Autocomplete(input_start);

    var input_end = document.getElementById("placeEnd");
    var autocompleteStart = new google.maps.places.Autocomplete(input_start);
    var autocompleteEnd = new google.maps.places.Autocomplete(input_end);
    var infoWindow = new google.maps.InfoWindow();
    var geocoder = new google.maps.Geocoder();
    // =======dung trong check in vi tri ,share post======
    var input_location_share = document.getElementsByClassName("locationInPostShare")[0];

    var autoComplateShare = new google.maps.places.Autocomplete(input_location_share);
    autoComplateShare.setFields(["place_id", "geometry", "name", "formatted_address"]);
    autoComplateShare.addListener('place_changed', () => {
        var place = autoComplateShare.getPlace();
        var place_id = place.place_id;

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
                                // console.log(results[0].formatted_address);

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
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
    });
    // Trong cap nhat
    var input_location_share1 = document.getElementsByClassName("locationInPostShare1")[0];

    var autoComplateShare1 = new google.maps.places.Autocomplete(input_location_share1);
    autoComplateShare1.setFields(["place_id", "geometry", "name", "formatted_address"]);
    autoComplateShare1.addListener('place_changed', () => {
        var place = autoComplateShare1.getPlace();
        var place_id = place.place_id;

        var html = '<span>Đang ở </span>' +
            '<span class="title"> ' + place.formatted_address + '</span>';
        $('#form-update-post-share .info-desc .location').html(html);
        $('#form-update-post-share .checkin-location').val(place.formatted_address);

    })
    // Su kien click ay vi tri hien tai
    var locationButtonShare1 = document.getElementsByClassName("button-location-share1")[0];
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
                                $('#form-update-post-share .location').html(html);
                                $('#form-update-post-share .checkin-location').val(results[0]
                                    .formatted_address);
                                // console.log(results[0].formatted_address);

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
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
    });

    // ==============
    autocompleteStart.bindTo("bounds", mapInfoTrip);
    autocompleteStart.setFields(["place_id", "geometry", "name"]);
    autocompleteStart.addListener('place_changed', () => {
        var place = autocompleteStart.getPlace();
        console.log(place.name)
        var place_id = place.place_id;
        $('#info-trip .place-start').val(place.name);
        $('#info-trip #id_place_start').val(place_id);
        // console.log(place_id);
    })
    // ket thuc
    autocompleteEnd.bindTo("bounds", mapInfoTrip);
    autocompleteEnd.setFields(["place_id", "geometry", "name"]);
    autocompleteEnd.addListener('place_changed', () => {
        var place = autocompleteEnd.getPlace();
        var place_id = place.place_id;
        $('#info-trip .place-end').val(place.name);
        $('#info-trip #id_place_end').val(place_id);

    })
    // 1. ket thuc Lay thong tin dia diem cho chuyen di
    // 2 . Chi duong di
    var input_start_route = document.getElementById("input-start-route");
    var place_id = "";

    var mapRoute = new google.maps.Map(document.getElementById('mapRoute'), {
        mapTypeControl: false,
        center: location,
        zoom: 13
    });
    mapRoute.controls[google.maps.ControlPosition.TOP_LEFT].push(input_start_route);

    var autocompleteRoute = new google.maps.places.Autocomplete(input_start_route);
    var directionsService = new google.maps.DirectionsService();
    var directionsRenderer = new google.maps.DirectionsRenderer();
    // ==== Button lay vi tri hien tai===
    // =======button lay vi tri hien tai========
    var locationButton = document.getElementById("button-location");
    mapRoute.controls[google.maps.ControlPosition.LEFT].push(locationButton);
    // ==============
    autocompleteRoute.bindTo("bounds", mapRoute);
    autocompleteRoute.setFields(["place_id", "geometry", "name"]);
    // set map null
    directionsRenderer.setMap(mapRoute);

    // Place change
    autocompleteRoute.addListener('place_changed', () => {
        var place = autocompleteRoute.getPlace();
        place_id = place.place_id;
        // directionsRenderer.set('directions', null);

        // Tra ve ket qua chi duong
        var idStartEndPlace = {
            start: place_id,
            end: id_place_place_end
        };
        directionRoute(idStartEndPlace, directionsRenderer, directionsService);

    })
    // Su kien click ay vi tri hien tai
    locationButton.addEventListener("click", () => {
        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    // console.log(position)
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };

                    mapRoute.setCenter(pos);

                    // Lay vi tri nguoc
                    geocoder.geocode({
                        location: pos
                    }, (results, status) => {
                        if (status === "OK") {
                            if (results[0]) {
                                console.log(results[0]);
                                var idStartEndPlace = {
                                    start: results[0].place_id,
                                    end: id_place_place_end
                                };
                                mapRoute.setZoom(11);
                                const marker = new google.maps.Marker({
                                    position: pos,
                                    map: mapRoute,
                                });
                                directionRoute(idStartEndPlace, directionsRenderer,
                                    directionsService);
                                infoWindow.setContent(results[0].formatted_address);
                                infoWindow.open(mapRoute, marker);
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
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
    });

}
// Goi ham hien thi thong tin tren infowindow
function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(
        browserHasGeolocation ?
        "Error: The Geolocation service failed." :
        "Error: Your browser doesn't support geolocation."
    );
    infoWindow.open(map);
}
// GOi ham chi duong
function directionRoute(placeId, directionsRenderer, directionsService) {
    directionsService.route({
        origin: {
            placeId: placeId.start
        },
        destination: {
            placeId: placeId.end
        },
        travelMode: 'DRIVING'
    }, function(response, status) {
        // cac buoc di 

        var legs = response.routes[0].legs[0];
        var steps = legs.steps;
        // console.log(legs);
        // console.log(steps);
        if (status === 'OK') {
            // Tra ve huong dan duong di hien thi len html
            var result_html = '<div class="item mt-1">' +
                '<div class="btn btn-info w-100" data-toggle="collapse"' +
                'data-target="#street0" aria-expanded="true">' + legs.end_address + '(còn ' + legs.distance
                .text + ')</div>' +
                '<div id="street" class=" text-left collapse show" style="">' +
                '<h5 class="distance">Thời gian: ' + legs.duration.text + '</h5>' +
                '<h5 class="start_address">Từ: ' + legs.start_address + '</h5>' +
                '<h5 class="end_address">Đến: ' + legs.end_address + '</h5>';

            for (var j = 0; j < steps.length; j++) {
                var k = j + 1;
                result_html += '<p><b>' + k + '</b>.' + steps[j].instructions + ' (' + steps[j].distance
                    .text +
                    ')</p>';
            }
            result_html += '</div></div>';
            // Set map chi duong 
            $('#result_derection').html(result_html);
            directionsRenderer.setDirections(response);
        } else {
            window.alert('Directions request failed due to ' + status);
        }
    });
}

// === Show input location in check in share post==
$('#form-post-share .fa-map-marker-alt,#form-update-post-share .fa-map-marker-alt').click(function() {
    $('.wp-input-location-share').toggleClass('d-none');
})
// 1. Cap nhat thong tin chuyen di
updateInfoTrip();

function updateInfoTrip() {
    $('#form-update-info-trip-team').on('submit', function(e) {
        e.preventDefault();
        var title_trip = $('#form-update-info-trip-team .title-trip').val();
        var place_start = $('#form-update-info-trip-team .place-start').val();
        var place_end = $('#form-update-info-trip-team .place-end').val();
        var start_day = $('#form-update-info-trip-team .start-day').val();
        var end_day = $('#form-update-info-trip-team .end-day').val();
        var id_place_start = $('#form-update-info-trip-team #id_place_start').val();
        var id_place_end = $('#form-update-info-trip-team #id_place_end').val();

        // kiem tra rong
        $('#error-title-trip').html('');
        $('#error-place-start').html('');
        $('#error-place-end').html('');
        $('#error-start-day').html('');
        $('#error-end-day ').html('');
        if (title_trip == "" || place_start == "" || place_end == "" || start_day == "" || end_day == "") {

            if (title_trip == "") {
                $('#error-title-trip').html('Tiêu đề không được trống');
            }
            if (place_start == "") {
                $('#error-place-start').html('Bạn chưa chọn địa điểm xuất phát');
            }
            if (place_end == "") {
                $('#error-place-end').html('Bạn chưa chọn điểm đến');
            }
            if (start_day == "") {
                $('#error-start-day').html('Bạn chưa chọn ngày đi');
            }
            if (end_day == "") {
                $('#error-end-day').html('Bạn chưa chọn ngày đến');
            }
        } else {
            var data = new FormData(this);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'team/update-info-trip-team',
                type: 'post',
                dataType: 'json',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    $('#form-update-info-trip-team .alert-default-info')
                        .removeClass('d-none');
                    var a = setInterval(function() {
                        $('#form-update-info-trip-team .alert-default-info')
                            .addClass('d-none');
                        location.reload();
                    }, 2000);
                }
            })
        }

    })
}


// =====================================================================
// =============== PHAN KE HOACH, VAT DUNG =================
// =====================================================================

// 1. Lay view ke hoach
$('#custom-tabs-plan').click(function() {
    $.ajax({
        url: 'team/get-view-plan/' + team_id,
        type: "get",
        success: function(data) {
            $('#plan').html(data);
            showFormCreateTool();
            createTool();
            checkChecked();
            sendFormComfirmTool();
            updateComfirmTool();
            deleteTool();
            getModalUpdateTeam();
        },
    });
})
// 2. Show form tao binh chon
function showFormCreateTool() {
    $('.create-poll').click(function() {
        $('#form-create-poll').toggleClass('d-none');
    })
}
// 3. Tao vat dung, binh chon
function createTool() {
    $('#form-create-poll').on('submit', function(e) {
        e.preventDefault();
        var name_tool = $('#form-create-poll .name-tool').val();

        if (name_tool == "") {
            alert('Bạn chưa nhập thông tin');
        } else {
            // alert('ok')
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'team/create-tool',
                dataType: 'json',
                data: {
                    name_tool: name_tool,
                    team_id: team_id
                },
                type: 'post',
                success: function(data) {
                    if (data.success) {
                        $('#form-create-poll .name-tool').val('');
                        $('#tool-list ul').append(data.html);
                        checkChecked();
                        getViewThongKe();
                    }
                }
            })
        }


    })
}
// 4. check Binh chon vat cung
function checkChecked() {
    $('#tool-list li input[type="checkbox"]').click(function() {
        var id = $(this).attr('id');
        if ($(this).is(":checked")) {

            $('.sl-' + id).removeClass('d-none');
        } else {

            $('.sl-' + id).addClass('d-none');
        }

        var num = $('#tool-list input[type="checkbox"]:checked').length;
        if (num == 0) {
            $('.comfirm-tool').addClass('d-none');
            console.log('chua co chon')
        } else {
            $('.comfirm-tool').removeClass('d-none');
            console.log('da co chon')
        }
        // console.log(num)
    })


}
// 5. Gui binh chon vat dung
function sendFormComfirmTool() {
    $('#form-comfirm-tool').on('submit', function(e) {
        e.preventDefault();
        var data = new FormData(this);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'team/comfirm-tool-ajax',
            type: 'post',
            dataType: 'json',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data);
                getViewVoted();
                getViewThongKe();
            }
        })
    })
}
// 6. Tra ve view thong ke
function getViewThongKe() {
    $.ajax({
        url: 'team/get-view-thongke/' + team_id,
        type: "get",
        success: function(data) {
            $('#thongkebinhchon').html(data);

        },
    });
}
// 7. cap nhat lai binh chon
function updateComfirmTool() {
    $('#form-update-comfirm-tool').on('submit', function(e) {
        e.preventDefault();
        var data = new FormData(this);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'team/update-comfirm-tool-ajax',
            type: 'post',
            dataType: 'json',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data);
                getViewVoted();
                getViewThongKe();
                deleteTool();
            }
        })
    })
}
// 8. Get view binh chon
function getViewVoted() {
    $.ajax({
        url: 'team/get-view-voted/' + team_id,
        type: "get",
        success: function(data) {
            $('#tool-list').html(data);
            console.log(data);
            showFormCreateTool();
            createTool();
            checkChecked();
            updateComfirmTool();
            sendFormComfirmTool();
            deleteTool();
        },
    });
}
// 9. Xoa cong cu vat dung
function deleteTool() {
    $('.delete-tool').click(function(e) {
        var tool_id = e.target.id;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'team/delete-tool',
            dataType: 'json',
            data: {
                tool_id: tool_id,
            },
            type: 'post',
            success: function(data) {
                getViewVoted();
                getViewThongKe();
                console.log(data);
            }
        })
    })
}
// 10. Lay modal cap nhat team

function getModalUpdateTeam() {
    $("#editTeam").on('shown.bs.modal', function(e) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'team/get-modal-update-team',
            dataType: 'json',
            data: {
                team_id: team_id
            },
            type: 'post',
            success: function(data) {
                $('#editTeam #form-update-team .title-team').val(data.team.title);
                $('#editTeam #form-update-team .summernote').summernote('code', data.team
                    .content);
                // updatePlanTeam();
                console.log(data);
            }
        })
    })
}
// 11. Cap nhat lai ke hoach tren team
updatePlanTeam();

function updatePlanTeam() {
    $('#form-update-team').on('submit', function(e) {
        e.preventDefault();
        var title_team = $('#editTeam #form-update-team .title-team').val();
        var content_team = $('#editTeam #form-update-team #content-team').val();

        $('#editTeam #error-title').html('');
        $('#editTeam #error-content').html('');
        if (title_team == "" || content_team == "") {
            if (title_team == "") {
                $('#editTeam #error-title').html('Tiêu đề không được trống');
            }
            if (content_team == "") {
                $('#editTeam #error-content').html('Nội dung không được trống');
            }
        } else {

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'team/update-team-plan',
                dataType: 'json',
                data: {
                    title_team: title_team,
                    content_team: content_team,
                    team_id: team_id
                },
                type: 'post',
                success: function(data) {
                    console.log(data);
                    if (data.success) {

                        $('#editTeam .alert-default-info').removeClass(
                            'd-none');
                        $('#editTeam').find('form')[0].reset();
                        var a = setInterval(function() {
                            $('#editTeam .alert-default-info')
                                .addClass('d-none');
                            $('#editTeam').modal('hide');
                            $('#result-content-plan-team').html(content_team);
                            clearInterval(a);
                        }, 2000);

                    }
                }
            })
        }

    })
}

// ===== LAY VIEW DANH SACH THANH VIEN ==
$('#custom-tabs-member-team').click(function() {
    $.ajax({
        url: 'team/get-view-member-team/' + team_id,
        type: "get",
        success: function(data) {
            $('#member-team').html(data);
            updateProfileMember();
        },
    });
})
// ==== LAY VIEW THONG TIN CA NHAN ====
$('#custom-tabs-info-profile-member').click(function() {
    $.ajax({
        url: 'team/get-view-profile-member/' + team_id,
        type: "get",
        success: function(data) {
            $('#info-profile-member').html(data);
            updateProfileMember();
        },
    });
})
// ==== CAP NHAT THONG TIN CA NHAN ======
function updateProfileMember() {
    $('#form-update-profile-member').on('submit', function(e) {
        e.preventDefault();
        var fullname = $('#form-update-profile-member #fullname').val();
        var phone = $('#form-update-profile-member #phone').val();

        var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;

        $('#form-update-profile-member #error-fullname').html(' ');
        $('#form-update-profile-member #error-phone').html(' ');

        if (fullname == "" || phone == "") {
            if (fullname == "") {
                $('#form-update-profile-member #error-fullname').html('Họ và tên không được trống');
            }

            if (phone == '') {
                $('#form-update-profile-member #error-phone').html('Bạn chưa điền số điện thoại!');
            }
        } else {
            if (phone !== '') {
                if (vnf_regex.test(phone) == false) {
                    $('#form-update-profile-member #error-phone').html(
                        'Số điện thoại của bạn không đúng định dạng!');
                } else {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: 'team/update-profile-member',
                        dataType: 'json',
                        data: {
                            fullname: fullname,
                            phone: phone,
                            team_id: team_id
                        },
                        type: 'post',
                        success: function(data) {

                            if (data.success) {

                                $('#form-update-profile-member .alert-default-info')
                                    .removeClass(
                                        'd-none');
                                $('#custom-tabs-info-profile-member .badge').remove();
                                $('#form-update-profile-member .alert-danger').remove();
                                var a = setInterval(function() {
                                    $('#form-update-profile-member .alert-default-info')
                                        .addClass('d-none');
                                    clearInterval(a);
                                }, 2500);

                            }
                        }
                    })
                }
            }

        }
    })
}
// ==== SOC KET SEND MESSAGES ===
var socket = io('http://localhost:6001');
// 1. Tao secket lang nge su tu tin nhan gui
socket.on('laravel_database_chat_room:chat_room', function(data) {

    // console.log(data.message_room)
    if (data.message_room.team_id == team_id && data.message_room.user_send != user_id) {
        $('#chat-room .direct-chat-messages').append(data.message_room.html)
        scrollToBottom();

    }


})
// 2. Binh luan post share
socket.on('laravel_database_comment_post_share:comment_post_share', function(data) {
    if (user_id != data.data_comment.user_id) {
        $('#post-share-id-' + data.data_comment.post_share_id + ' .card-comments').append(data.data_comment
            .html);
    }


})
// ==== GUI TIN NHAN TRONG TEAM ====
chatRoom();

function chatRoom() {
    $('#chat-room .send-message').on('keyup', function(e) {

        if (e.key === 'Enter') {

            if ($(this).val() != '') {
                var content = $(this).val();
                var team_id = "{{$team->id}}";
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'team/send-message-ajax',
                    dataType: 'json',
                    data: {
                        content: content,
                        team_id: team_id
                    },
                    type: "post",
                    success: function(data) {
                        // $('#wp-box-messages .direct-chat-messages').append(data.html)
                        $('#chat-room .direct-chat-messages').append(data.html);
                        scrollToBottom()

                    },

                });
                $(this).val(' ');
            }
        }
    })
}
// ==== LAY VIEW CHAT =====
$('#custom-tabs-chat-room').click(function(e) {
    $.ajax({

        url: 'team/get-view-chat-room/' + team_id,
        type: "get",
        success: function(data) {
            console.log(data)
            $('#chat-room').html(data);
            scrollToBottom()
            chatRoom();
        },

    });
})

function scrollToBottom() {
    $('.direct-chat-messages').animate({
        scrollTop: $('.direct-chat-messages').get(0).scrollHeight
    }, 50);
}
// === THAM GIA VAO TEAM ========
$('#form-join-team').on('submit', function(e) {
    e.preventDefault();
    var fullname = $('#form-join-team .fullname').val();
    var phone = $('#form-join-team .phone').val();
    var team_id = "{{$team->id}}";
    var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;

    $('#form-join-team #error-fullname').html(' ');
    $('#form-join-team #error-phone').html(' ');

    if (fullname == "" || phone == "") {
        if (fullname == "") {
            $('#form-join-team #error-fullname').html('Họ và tên không được trống');
        }

        if (phone == '') {
            $('#form-join-team #error-phone').html('Bạn chưa điền số điện thoại!');
        }
    } else {
        if (phone !== '') {
            if (vnf_regex.test(phone) == false) {
                $('#form-join-team #error-phone').html('Số điện thoại của bạn không đúng định dạng!');
            } else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'team/join-team',
                    dataType: 'json',
                    data: {
                        fullname: fullname,
                        phone: phone,
                        team_id: team_id
                    },
                    type: 'post',
                    success: function(data) {
                        console.log(data);
                        if (data.success) {

                            $('#join-team .alert-default-info').removeClass('d-none');
                            var a = setInterval(function() {
                                $('#join-team .alert-default-info').addClass('d-none');
                                $('#join-team').modal('hide');
                                clearInterval(a);
                                location.reload()
                            }, 2500);

                        }
                    }
                })
            }
        }

    }


})
</script>
<!-- owlcarowsel -->
<script>
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