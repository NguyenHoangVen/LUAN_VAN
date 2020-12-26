
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
                <a href="http://localhost:8000/group-post/admin/24/post-pending" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bài Viết Chờ Duyệt</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="http://localhost:8000/group-post/admin/24/post-report" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bài Viết Bị Báo Cáo</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin-page')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tất Cả Bài Viết</p>
                </a>
              </li>
              
            </ul>
          </li>
          
          <li class="nav-header">QUẢN LÍ TÀI KHOẢN NGƯỜI DÙNG</li>
          <li class="nav-item">
            <a href="{{url('admin-page')}}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Tất cả tài khoản</p>
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
