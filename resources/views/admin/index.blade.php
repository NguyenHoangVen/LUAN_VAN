
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ADMIN</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('Admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('Admin/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('Admin/dist/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('Admin/dist/css/admin.css')}}">
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

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link text-center">
      <span class="brand-text font-weight-light">ADMIN</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <div class="image">
        <img src="{{asset('image/logo/logophuot.png')}}"alt="User Image">
      </div>
      <!-- SidebarSearch Form -->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-header">QUẢN LÍ BÀI VIẾT</li>

          <li class="nav-item">
            <a href="{{url('admin-page/post-report')}}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Bài viết bị báo cáo</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin-page/topic-report')}}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Chủ đề bài viết bị báo cáo</p>
            </a>
          </li>
          <li class="nav-header">QUẢN LÍ TÀI KHOẢN NGƯỜI DÙNG</li>
          <li class="nav-item">
            <a href="{{url('admin-page')}}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Tất cả tài khoản</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin-page/logout')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Đăng xuất</p>
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
</div>
@yield('script')
<script>


    $('#check_all').on('click', function(e) {
     if($(this).is(':checked',true))  
     {
        $(".sub_check").prop('checked', true);  
     } else {  
        $(".sub_check").prop('checked',false);  
     }  
    });

</script>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- Bootstrap -->
<script src="{{asset('Admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<!-- AdminLTE App -->
<script src="{{asset('Admin/dist/js/adminlte.js')}}"></script>


</body>
</html>
