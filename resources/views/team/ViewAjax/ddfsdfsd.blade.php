<div class="wp-post-share">

    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6 col-md-12">
            <div class="central-meta postbox">
                <span class="create-post">Create post</span>
                <div class="new-postbox">
                    <div class="avatar d-block float-left"><img
                            src="image/image_avatar/1542276278-405-kieu-trinh-3-1542275166-width650height433.jpg"
                            alt=""></div>
                    <div class="newpst-input">
                        <!-- <form method="post"> -->
                        <textarea rows="2" data-toggle="modal" data-target="#modalCreatPostShare"
                            placeholder="Share some what you are thinking?"></textarea>
                        <!-- </form> -->
                    </div>


                </div>
            </div>
            <!-- Danh sach cac bao chia se trong team -->
            <div class="share-post">
                @for($i = 0;$i <=5;$i++) <div class="col-12 diary mt-0">
                    <div class="row mb-4">
                        <div class="bg-white pt-pb-15">

                            <div class="col-12 info-user d-flex mb-2">
                                <a href="" class="avatar d-block"><img
                                        src="image/image_avatar/1542276278-405-kieu-trinh-3-1542275166-width650height433.jpg"
                                        alt=""></a>
                                <div class="username-time ml-3 d-flex justify-content-between w-100">
                                    <div>
                                        <a href="" class="username">Carter Post
                                            Album</a>
                                        <span class="time">đã viết bài viêt này vào
                                            4/5/555</span>
                                    </div>
                                    <div class="report-follow dropdown dropleft"><i class="fas fa-ellipsis-h"
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
                                    <img class="img-circle img-sm" src="image/image_avatar/{{Auth::user()->avatar}}"
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
                                    <img class="img-circle img-sm" src="image/image_avatar/{{Auth::user()->avatar}}"
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
                                        src="image/image_avatar/{{Auth::user()->avatar}}" alt="Alt Text">
                                    <!-- .img-push is used to add margin to elements next to floating images -->
                                    <div class="img-push">
                                        <input type="text" class="form-control form-control-sm"
                                            placeholder="Press enter to post comment">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

            </div>
            @endfor
        </div>
        <div class="col-lg-3"></div>
    </div>

</div>
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
                <form action="" id="form-post-share">
                    <div class="info-user d-flex">
                        <div class="avatar d-block mr-3">
                            <img class="img-50"
                                src="image/image_avatar/1542276278-405-kieu-trinh-3-1542275166-width650height433.jpg"
                                alt="">
                        </div>
                        <div class="info-desc">
                            <div class="title">Carter Post
                                Album</div>
                            <span class="time">đã viết bài viêt này vào
                                4/5/555gfffffffffffffffffffffffffgfgfg</span>
                        </div>

                    </div>

                    <textarea name="content" id="" class="w-100" rows="5"
                        placeholder="Hôm nay bạn thế nào..."></textarea>
                    <!-- Image review -->
                    <ul>
                        <li>
                            <span class="add-loc">
                                <i class="fa fa-map-marker"></i>
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
                                <input type="file">
                            </label>
                        </li>
                        <li>
                            <i class="fa fa-video-camera"></i>
                            <label class="fileContainer">
                                <input type="file">
                            </label>
                        </li>
                        <li>
                            <i class="fa fa-camera"></i>
                            <label class="fileContainer">
                                <input type="file">
                            </label>
                        </li>
                        <li class="preview-btn">
                            <button class="post-btn-preview" type="submit" data-ripple="">Preview</button>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>
</div>