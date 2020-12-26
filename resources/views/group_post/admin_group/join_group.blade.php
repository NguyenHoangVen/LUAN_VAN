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
          <div class="row d-flex align-items-stretch">
            @if(count($user_join) > 0)
            @foreach($user_join as $item)
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch user{{$item->id}}">
              <div class="card bg-light ">
                <div class="card-header text-muted border-bottom-0">
                  Yêu cầu tham gia nhóm
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>{{$item->username}}</b></h2>
                      
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: {{$item->address}}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Ngày gửi: {{$item->ngaygui}}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="{{asset('image/image_avatar')}}/{{$item->avatar}}" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <div class="btn btn-sm bg-teal accept-request">
                      Chấp Nhận
                      <input type="hidden" name="user_id" class="user_id" value="{{$item->id}}">
                      <input type="hidden" name="group_id" class="group_id" value="{{$group->id}}">
                    </div>
                    <a href="{{url('profile')}}/{{$item->id}}" class="btn btn-sm btn-primary">
                      <i class="fas fa-user"></i> View Profile
                    </a>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
            @else
            <div class="col-12 ">
              <div class="alert alert-default-primary">
                Không có yêu cầu tham gia nào.
              </div>
            </div>
            @endif
          	
          
           
          </div>
        </div>
        <!-- /.card-body -->
      <!--   <div class="card-footer">
          <nav aria-label="Contacts Page Navigation">
            <ul class="pagination justify-content-center m-0">
              <li class="page-item active"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">4</a></li>
              <li class="page-item"><a class="page-link" href="#">5</a></li>
              <li class="page-item"><a class="page-link" href="#">6</a></li>
              <li class="page-item"><a class="page-link" href="#">7</a></li>
              <li class="page-item"><a class="page-link" href="#">8</a></li>
            </ul>
          </nav>
        </div> -->
        <!-- /.card-footer -->
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