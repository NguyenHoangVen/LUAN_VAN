@extends('group_post.admin_group.index')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lí yêu cầu vào nhóm</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('group-post/admin')}}/{{$group->id}}">Home</a></li>
              <li class="breadcrumb-item active">Danh sách yêu cầu</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body pb-0">
          <div class="row">
            @if(count($user_join) > 0)
            @foreach($user_join as $item)
            <div class="col-lg-6 col-md-12 user{{$item->id}}">
                <div class="card">
                    <div class="card-body p-2 ">
                        <div class="respon-card d-flex justify-content-between">
                            <div class="d-flex">
                                <div class="avatar" style="width: 50px;height: 50px">
                                    <a href="{{url('user')}}/{{$item->id}}/info" target="_blank">
                                        <img src="{{asset('image/image_avatar')}}/{{$item->avatar}}" alt="" class="w-100 h-100">
                                    </a>
                                </div>
                                <div class="username"><a href="{{url('user')}}/{{$item->id}}/info" target="_blank">{{$item->username}}</a></div>
                            </div>
                            <div class="pt-2">
                              <div class="btn bg-teal accept-request">Chấp nhận
                                <input type="hidden" name="user_id" class="user_id" value="{{$item->id}}">
                                <input type="hidden" name="group_id" class="group_id" value="{{$group->id}}">
                              </div>
                              <a href="{{url('user')}}/{{$item->id}}/info" class="btn btn-primary" target="_blank">
                                <i class="fas fa-user"></i> View Profile
                              </a>
                            </div>
                           <!--  <div class="send mt-1 dropdown show">
                                <button class="btn btn-light w-100" data-toggle="dropdown" aria-expanded="true">Bạn
                                    bè</button>
                                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                    <div class="dropdown-item delete-friend">Xóa bạn <input type="hidden" class="friend-id" value="2"></div>
                                </div>
                            </div> -->

                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="col-lg-6 col-md-12 alert alert-default-primary">Không có yêu cầu tham gia nào</div>
              
            @endif
           
          	
          
           
          </div>
        </div>

      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
@endsection
@section('script')
<script>
  $('.accept-request').click(function(){
    var user_id = $(this).find('.user_id').val();
    $('.user'+user_id).remove();
    var group_id = $(this).find('.group_id').val();
    var data = {user_id:user_id,group_id:group_id}
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "{{url('group-post/admin/accept-ajax')}}",
      dataType:'json',
      data: data,
      type:'post',
      success:function(data){
        console.log(data);
      }
    })
    return false;
  })
</script>
@endsection