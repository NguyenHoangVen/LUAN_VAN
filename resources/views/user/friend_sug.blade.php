<div class="list-friends">
    <div class="row">

        @foreach($list_user as $friend)
        @if(!checkFriend(Auth::user()->id,$friend->id))
        @if(!checkInvited(Auth::user()->id,$friend->id))
        <div class="col-lg-6 col-md-12 mb-1 friend-{{$friend->id}}">
            <div class="card">
                <div class="card-body p-2 ">
                    <div class="respon-card">
                        <div class="d-flex">
                            <div class="avatar" style="width: 50px;height: 50px">
                                <a href="user/{{$friend->id}}/info">
                                    <img src="image/image_avatar/{{$friend->avatar}}" alt="" class="w-100 h-100">
                                </a>
                            </div>
                            <div class="username"><a href="user/{{$friend->id}}/info">{{$friend->username}}</a></div>
                        </div>

                        <div class="send mt-1"><button class="btn btn-primary w-100 send-request">Thêm bạn
                                <input type="hidden" class="receive_id" value="{{$friend->id}}">
                                <!-- <input type="hidden" class="status" value="send"> -->
                            </button></div>

                    </div>
                </div>
            </div>
        </div>
        @endif
        @endif
        @endforeach
    </div>
</div>