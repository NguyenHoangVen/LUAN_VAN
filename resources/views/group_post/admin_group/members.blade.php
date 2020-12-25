@extends('group_post.admin_group.index')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lí thành viên trong nhóm</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('group-post/admin')}}/{{$group->id}}">Home</a></li>
              <li class="breadcrumb-item active">Danh sách thành viên</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body pb-0">
          <div class="btn alert-default-primary mb-2">
            <i class="fas fa-users"></i>
            {{count($members)+1}} Thành viên
          </div>
          <div class="row">
            @if(count($members) > 0)
            @foreach($members as $item)
            <div class="col-lg-6 col-md-12 user{{$item->user->id}}">
                <div class="card">
                    <div class="card-body p-2 ">
                        <div class="respon-card d-flex justify-content-between">
                            <div class="d-flex">
                                <div class="avatar" style="width: 50px;height: 50px">
                                    <a href="user/2/info" target="_blank">
                                        <img src="{{asset('image/image_avatar')}}/{{$item->user->avatar}}" alt="" class="w-100 h-100">
                                    </a>
                                </div>
                                <div class="username"><a href="user/2/info" target="_blank">{{$item->user->username}}</a></div>
                            </div>
                            <div class="pt-2">
                              <div class="btn bg-teal out-group"><i class="fas fa-user"></i>   Mời rời nhóm
                                <input type="hidden" name="user_id" class="user_id" value="{{$item->user->id}}">
                                <input type="hidden" name="group_id" class="group_id" value="{{$group->id}}">
                              </div>
                              
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="col-lg-6 col-md-12 alert alert-default-primary">Không có thành viên nào trong nhóm</div>
              
            @endif

          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
@section('script')
<script>
  $('.out-group').click(function(){
    var r = confirm("Bạn có muốn cho người này ra khỏi nhóm?");
    if(r == true){
      var user_id = $(this).find('.user_id').val();
      var group_id = $(this).find('.group_id').val();
      var data = {user_id:user_id,group_id:group_id}
      
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{url('group-post/admin/leave-group-member')}}",
        dataType:'json',
        data: data,
        type:'post',
        success:function(data){
          console.log(data);
          $('.user'+user_id).remove();
          toastr.success('Đã mời ra khỏi nhóm','',{timeOut: 1500})
        }
      })
      
    }
  })

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