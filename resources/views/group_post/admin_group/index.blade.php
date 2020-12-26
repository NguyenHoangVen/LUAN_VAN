
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Quản trị nhóm</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('Admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('Admin/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('Admin/dist/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('Admin/dist/scss/_main-sidebar.scss')}}">
  <!-- Summernote -->
  <link rel="stylesheet" href="{{asset('Admin/plugins/summernote/summernote-bs4.min.css')}}">
  <script src="{{asset('Admin/plugins/jquery/jquery.min.js')}}"></script>
  <!-- <script src="{{asset('Admin/plugins/summernote/summernote-bs4.min.js')}}"></script> -->
  <script src="{{asset('js/custom.js')}}"></script>
  <script src="{{asset('Toastr/toastr.min.js')}}"></script>
  <link rel="stylesheet" href="{{asset('Toastr/toastr.min.css')}}">
 
  
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light ">
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset('Admin/dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset('Admin/dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset('Admin/dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>

  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('group-post/admin/')}}/{{$group->id}}" class="brand-link">
      <img src="{{asset('upload/avatar_group')}}/{{$group->avatar}}"  class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{$group->name}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('image/image_avatar')}}/{{$group->user->avatar}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{url('group-post')}}" class="d-block">{{$group->user->username}}</a>
        </div>
      </div>
      <!-- SidebarSearch Form -->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                QUẢN LÍ BÀI VIẾT
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('group-post/admin')}}/{{$group->id}}/post-pending" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bài Viết Chờ Duyệt</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('group-post/admin')}}/{{$group->id}}/post-report" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bài Viết Bị Báo Cáo</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('group-post/admin')}}/{{$group->id}}/all-post" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tất Cả Bài Viết</p>
                </a>
              </li>
              
            </ul>
          </li>
          
          <li class="nav-header">THÀNH VIÊN NHÓM</li>
          <li class="nav-item">
            <a href="{{url('group-post/admin/'.$group->id.'/join-group')}}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Danh sách yêu cầu</p>
            </a>
          </li>
        
          <li class="nav-item">
            <a href="{{url('group-post/admin/'.$group->id.'/members')}}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Danh sách thành viên</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p class="text" data-toggle='modal' data-target="#modalInfoGroup">Thông tin nhóm</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('group-post/admin/delete-group')}}/{{$group->id}}" class="nav-link" onclick="return confirm('Bạn có chắc muốn xóa nhóm này?')">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Xóa nhóm</p>
            </a>
          </li>
          
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  @yield('content')

  <!-- /.content-wrapper -->
  <!-- modal thong tin nhom -->
    <div id="modalInfoGroup" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Thông tin về nhóm</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form method="" id="form-update-group">
             
              <div class="row">
                <div class="col-12 form-group">
                  <label for="">Tên nhóm <span style="color: red">*</span></label>
                  <p class="form-error error-name-group"></p>
                  <input type="text" class="form-control" name="name_group" id="name_group" value="{{$group->name}}">
                  <input type="hidden" name="group_id" value="{{$group->id}}">
                </div>
                <div class="col-12">
                  <div class="title-action d-flex justify-content-between">
                    <h1>Ảnh bìa</h1>
                    <a href="">Chỉnh sửa <input type="file" class="input-file-imgcover" name="image"></a>
                  </div>
                </div>
                <div class="col-12 center-webkit">
                  <div class="image-cover">
                    <img class="changeSrcImgCover img_cover1" src="{{asset('image/image_cover')}}/{{$group->avatar}}" alt="">
                  </div>
                </div>
                
              </div>
              <div class="alert alert-default-info d-none mt-2">Cập nhật thành công</div>
              <input class="btn btn-success w-100 mt-2" type="submit" name="submit" value="Cập nhật">

            </form>
            
          </div>
        </div>
      </div>
    </div>
</div>
@yield('script')
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- Bootstrap -->
<script src="{{asset('Admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<!-- AdminLTE App -->
<script src="{{asset('Admin/dist/js/adminlte.js')}}"></script>
<script type="text/javascript">
  $('#form-update-group').on('submit',function(e){
    e.preventDefault();
    var name = $('#name_group').val();
    $('.error-name-group').html(' ');
    if(name == ""){
      $('.error-name-group').html('Tên nhóm không được trống');
    }else{
      var data = new FormData(this);
      $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{url('group-post/admin/update-group-post')}}",
        dataType:'json',
        data: data,
        type:'post',
        cache:false,
        contentType: false,
        processData: false,
        success:function(data){
          console.log(data)
       
              
            $('.alert-default-info').removeClass('d-none');
            var a = setInterval(function(){ 
            $('.alert-default-info').addClass('d-none');
            $('#modalInfoGroup').modal('hide');   
            clearInterval(a);
            location.reload()
            }, 2500);
          
        }
      })
    }
    
  })
</script>

</body>
</html>
