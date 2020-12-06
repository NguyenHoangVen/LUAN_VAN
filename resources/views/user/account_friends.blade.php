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
                <div class="col-lg-4 col-md-12">
                    <div class="setting-profile d-flex mt-2">
                        <a href="" class="btn btn-success w-100" data-toggle="modal" data-target="#editProfile">Sửa hồ
                            sơ</a>

                    </div>

                </div>
            </div>
        </div>
        <div class="container action-show mt-3">
            <div class="row">
                <!-- sidebar-left -->
                <!--  -->
                <div class="col-lg-9 col-md-12 diary mt-0 p-0">
                    <div class="bg-padding">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active tab-friend" href="#all-friends"
                                            data-toggle="tab">Tất cả bạn bè
                                            <input type="hidden" class="status" value="all-friend">
                                        </a></li>

                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <!-- TAT CA BAN BE -->
                                    <div class="active tab-pane" id="all-friends">

                                        <!-- LIST FRIENDS -->
                                        <div class="list-friends">
                                            <div class="row">
                                                @foreach($friend_of_user as $friend)
                                                @if($friend->id_user_accept == $user->id)
                                                <div
                                                    class="col-lg-6 col-md-12 mb-1 friend-{{$friend->user_accept->id}}">
                                                    <div class="card">
                                                        <div class="card-body p-2 ">
                                                            <div class="respon-card">
                                                                <div class="d-flex">
                                                                    <div class="avatar"
                                                                        style="width: 50px;height: 50px">
                                                                        <a href="">
                                                                            <img src="image/image_avatar/{{$friend->user_accept->avatar}}"
                                                                                alt="" class="w-100 h-100">
                                                                        </a>
                                                                    </div>
                                                                    <div class="username"><a
                                                                            href="">{{$friend->user_accept->username}}</a>
                                                                    </div>
                                                                </div>
                                                                @if(Auth::user()->id == $friend->id_user_send)
                                                                @else
                                                                @if(checkFriend(Auth::user()->id,$friend->id_user_send))
                                                                <div class="send mt-1 dropdown">

                                                                    <button class="btn btn-light w-100"
                                                                        data-toggle='dropdown'>Bạn bès</button>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                        <div class="dropdown-item delete-friend">Xóa bạn
                                                                            <input type="hidden" class="friend-id"
                                                                                value="{{$friend->user_accept->id}}">
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                @else
                                                                <div class="send mt-1"><button
                                                                        class="btn btn-primary w-100 send-request">Thêm
                                                                        bạn
                                                                        <input type="hidden" class="receive_id"
                                                                            value="{{$friend->id_user_send}}">
                                                                        <!-- <input type="hidden" class="status" value="send"> -->
                                                                    </button></div>
                                                                @endif
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="col-lg-6 col-md-12 mb-1 friend-{{$friend->user_send->id}}">
                                                    <div class="card">
                                                        <div class="card-body p-2 ">
                                                            <div class="respon-card">
                                                                <div class="d-flex">
                                                                    <div class="avatar"
                                                                        style="width: 50px;height: 50px">
                                                                        <a href="">
                                                                            <img src="image/image_avatar/{{$friend->user_send->avatar}}"
                                                                                alt="" class="w-100 h-100">
                                                                        </a>
                                                                    </div>
                                                                    <div class="username"><a
                                                                            href="">{{$friend->user_send->username}}</a>
                                                                    </div>
                                                                </div>
                                                                @if(Auth::user()->id == $friend->id_user_accept)
                                                                @else
                                                                @if(checkFriend(Auth::user()->id,$friend->id_user_accept))
                                                                <div class="send mt-1 dropdown">
                                                                    <button class="btn btn-light w-100"
                                                                        data-toggle='dropdown'>Bạn bv</button>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                        <div class="dropdown-item delete-friend">Xóa bạn
                                                                            <input type="hidden" class="friend-id"
                                                                                value="{{$friend->id_user_accept}}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @else
                                                                <div class="send mt-1"><button
                                                                        class="btn btn-primary w-100 send-request">Thêm
                                                                        bạn
                                                                        <input type="hidden" class="receive_id"
                                                                            value="{{$friend->id_user_accept}}">
                                                                        <!-- <input type="hidden" class="status" value="send"> -->
                                                                    </button></div>
                                                                @endif
                                                                @endif

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
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
@section('script')
<!--  -->
<script type="text/javascript">
// 	=== LAY ID CUA NGUOI DUNG===
var user_id_login = "{{$user->id}}";

// === AJAX SETTIN HEADER ==
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// === CLICK LAY TAT CA TRANG THAI THEO TAB===
// 1. Tab all friend
$('.tab-friend').on('click', function() {
    var status = $(this).find('.status').val();

    $.ajax({
        url: "{{url('user/get-tab-friend')}}",
        dataType: 'json',
        data: {
            status: status
        },
        type: 'post',
        success: function(data) {
            if (status == 'request') {
                $('#received-request .list-friends .row').html(data.html_result);
                receiveReuqest();
            }
            if (status == 'sended') {
                $('#sended-request .list-friends .row').html(data.html_result);
                deleteRequest();
            }
            if (status == 'all-friend') {
                $('#all-friends .list-friends .row').html(data.html_result);
                deleteFriend()
                // console.log(data)
            }


        }
    })

})
// == TIM KIEM TAT CA BAN BE ==
$('#form-search-all-friends').on('submit', function(e) {
    e.preventDefault();
    var key = $(this).find('.key').val();

    if (key != "") {
        $.ajax({
            url: "{{url('user/search-all-friend')}}",
            dataType: 'json',
            data: {
                key: key
            },
            type: 'post',
            success: function(data) {
                console.log(data)
                if (data.success) {
                    $('#search-all-friend .list-friends').html(data.user);
                    sendRequest();
                }
            }
        })
    }

})


// == XOA YEU CAU KET BAN ===
deleteRequest();

function deleteRequest() {
    $('.delete-request').click(function() {
        var receive_id = $(this).find('.receive_id').val();

        $.ajax({
            url: "{{url('user/delete-request-add-friend')}}",
            dataType: 'json',
            data: {
                receive_id: receive_id
            },
            type: 'post',
            success: function(data) {

                $('#sended-request .friend-' + data.result).remove();
                console.log(data)

            }
        })
    })
}
// == GUI YEU CAU KET BAN AJAX ==
sendRequest();

function sendRequest() {
    $('.send-request').click(function() {

        var receive_id = $(this).find('.receive_id').val();
        alert(receive_id)
        $.ajax({
            url: "{{url('user/send-request-add-friend')}}",
            dataType: 'json',
            data: {
                receive_id: receive_id
            },
            type: 'post',
            success: function(data) {
                $('#suggestions-friend .friend-' + receive_id).remove();
                deleteRequest();
            }
        })

    })
}


// == XOA BAN BE ===
deleteFriend()

function deleteFriend() {
    $('.delete-friend').on('click', function() {
        var friend_id = $(this).find('.friend-id').val();

        $.ajax({
            url: "{{url('user/delete-friend')}}",
            dataType: 'json',
            data: {
                friend_id: friend_id
            },
            type: 'post',
            success: function(data) {

                $('#all-friends .friend-' + friend_id).remove()
                console.log(data)
            }
        })
    })
}
</script>
@endsection