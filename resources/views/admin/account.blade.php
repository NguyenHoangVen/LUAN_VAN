@extends('admin.index')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lí tài khoản người dùng</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item active">Danh sách tài khoản</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body pb-0">
          <div class="row">
            <div class="btn alert-default-primary mb-2 num_account mr-4">
              <i class="fas fa-users"></i>
              {{count($list_account)}} Tài khoản
            </div>
            <form action="" class="form-search-account">
              <div class="d-flex">
                <input type="text" name="key" class="form-control fl key" placeholder="Nhập từ khóa tìm kiếm...">
                <button class="btn btn-default">
                  <i class="fas fa-fw fa-search"></i>
                </button>
              </div>
            </form>
          </div>
          <div class="row list-account">
            @if(count($list_account) > 0)
            @foreach($list_account as $item)
            <div class="col-lg-6 col-md-12 user{{$item->id}}">
                <div class="card">
                    <div class="card-body p-2 ">
                        <div class="respon-card d-flex justify-content-between">
                            <div class="d-flex">
                                <div class="avatar" style="width: 50px;height: 50px">
                                    <a href="user/2/info" target="_blank">
                                        <img src="{{asset('image/image_avatar')}}/{{$item->avatar}}" alt="" class="w-100 h-100">
                                    </a>
                                </div>
                                <div class="username"><a href="user/2/info" target="_blank">{{$item->username}}</a></div>
                            </div>
                            <div class="pt-2">
                              <div class="btn bg-teal delete-account"><i class="fas fa-user"></i>   Mời rời nhóm
                                <input type="hidden" name="user_id" class="user_id" value="{{$item->id}}">
                                
                              </div>
                              <div class="btn btn-primary" data-toggle='modal' data-target="#ModalViewInfo{{$item->id}}">
                                <i class="fas fa-user"></i> View Profile
                              </div>
                            </div>
                            
                           
                        </div>
                    </div>
                </div>
                <!-- Modal view info -->
                <div id="ModalViewInfo{{$item->id}}" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-body">
                          <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                              <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="{{asset('image/image_avatar')}}/{{$item->avatar}}" alt="User profile picture">
                              </div>

                              <h3 class="profile-username text-center">{{$item->username}}</h3>

                              <p class="text-muted text-center">
                                <?php
                                if($item->gender == 'male'){
                                  echo "Nam";
                                }else{
                                  echo "Nữ";
                                }
                                ?>
                              </p>

                              <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                  <b>{{$item->fullname}}</b> 
                                </li>
                                <li class="list-group-item">
                                  <b>{{$item->email}}</b> 
                                </li>
                                <li class="list-group-item">
                                  <b>{{$item->address}}</b>
                                </li>
                              </ul>
                            </div>
                          
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              
                <!-- ./Modal view info -->
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
  // search account
  $('.form-search-account').on('submit',function(e){
    e.preventDefault();
    var key = $(this).find('.key').val();
    if(key == ''){
      alert('Bạn chưa nhập từ khóa tìm kiếm');
    }else{
      $.ajax({
        url: "{{url('admin-page/search-account?key=')}}"+key,
        type:'get',
        success: function(data){
          console.log(data);
          $('.list-account').html(data);
          delete_account();
        }
      })
    }
    // e.reventDefault();
  })
  // Delete account
delete_account();
function delete_account(){
  $('.delete-account').click(function(){
    // alert('ok')
    var r = confirm("Bạn có muốn xóa tài khoản người này?");
    if(r == true){
      var user_id = $(this).find('.user_id').val();
      var data = {user_id:user_id}
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{url('admin-page/delete-account')}}",
        dataType:'json',
        data: data,
        type:'post',
        success:function(data){
          console.log(data);
          $('.num_account').html('<i class="fas fa-users"></i> '+data.number+' Tài khoản');
          $('.user'+user_id).remove();
          toastr.success('Đã xóa tài khoản người dùng','',{timeOut: 1500})
        }
      })
      
    }
  })
}
  
</script>
@endsection