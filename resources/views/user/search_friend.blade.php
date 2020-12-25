<div class="list-friends">
    <div class="row">

        @foreach($list_user as $friend)
        @if(checkFriend(Auth::user()->id,$friend->id))
        <div class="col-lg-6 col-md-12 mb-1 friend-{{$friend->id}}">
            <div class="card">
                <div class="card-body p-2 ">
                    <div class="respon-card">
                        <div class="d-flex">
                            <div class="avatar" style="width: 50px;height: 50px">
                                <a href="">
                                    <img src="image/image_avatar/{{$friend->avatar}}" alt="" class="w-100 h-100">
                                </a>
                            </div>
                            <div class="username"><a href="">{{$friend->username}}</a></div>
                        </div>
                        <div class="action">
                           <div class="send mt-1 dropdown">
                                <button class="btn btn-light w-100" data-toggle="dropdown" aria-expanded="false">Bạn bè</button>
                                <div class="dropdown-menu dropdown-menu-right" style="">
                                    <div class="dropdown-item delete-friend">Xóa bạn <input type="hidden" class="friend-id" value="{{$friend->id}}"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @elseif(checkSendInvite(Auth::user()->id,$friend->id))
        <div class="col-lg-6 col-md-12 mb-1 friend-{{$friend->id}}">
            <div class="card">
                <div class="card-body p-2 ">
                    <div class="respon-card">
                        <div class="d-flex">
                            <div class="avatar" style="width: 50px;height: 50px">
                                <a href="">
                                    <img src="image/image_avatar/{{$friend->avatar}}" alt="" class="w-100 h-100">
                                </a>
                            </div>
                            <div class="username"><a href="">{{$friend->username}}</a></div>
                        </div>
                        <div class="action">
                            <div class="send mt-1">
                                <button class="btn btn-danger w-100 delete-request">Hủy
                                    <input type="hidden" class="receive_id" value="{{$friend->id}}">
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @elseif(checkReceiveInvite(Auth::user()->id,$friend->id))
        <div class="col-lg-6 col-md-12 mb-1 friend-{{$friend->id}}">
            <div class="card">
                <div class="card-body p-2 ">
                    <div class="respon-card">
                        <div class="d-flex">
                            <div class="avatar" style="width: 50px;height: 50px">
                                <a href="">
                                    <img src="image/image_avatar/{{$friend->avatar}}" alt="" class="w-100 h-100">
                                </a>
                            </div>
                            <div class="username"><a href="">{{$friend->username}}</a></div>
                        </div>
                        <div class="action">
                            <div class="send mt-1"><button class="btn btn-success w-100 received-request">Chấp nhận
                            <input type="hidden" class="send_id" value="{{$friend->id}}">
                            </button></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="col-lg-6 col-md-12 mb-1 friend-{{$friend->id}}">
            <div class="card">
                <div class="card-body p-2 ">
                    <div class="respon-card">
                        <div class="d-flex">
                            <div class="avatar" style="width: 50px;height: 50px">
                                <a href="">
                                    <img src="image/image_avatar/{{$friend->avatar}}" alt="" class="w-100 h-100">
                                </a>
                            </div>
                            <div class="username"><a href="">{{$friend->username}}</a></div>
                        </div>
                        <div class="action">
                            <div class="send mt-1"><button class="btn btn-primary w-100 send-request">Thêm bạn
                                    <input type="hidden" class="receive_id" value="{{$friend->id}}">
                                </button></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
