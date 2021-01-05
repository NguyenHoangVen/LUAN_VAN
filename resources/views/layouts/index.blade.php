<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>LUAN VAN</title>
    <base href="{{asset('')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- <script src="bootstrap/js/bootstrap.min.js" type="text/javascript" charset="utf-8" async defer></script> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.dev.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script src="js/main.js" type="text/javascript" charset="utf-8" async defer></script>
    <script src="js/custom.js" type="text/javascript" charset="utf-8" async defer></script>
    <script type="text/javascript" src="js/ajax.js"></script>
    <link rel="stylesheet" href="{{asset('Admin/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <link rel="stylesheet" type="text/css" href="css/forum.css">
    <link rel="stylesheet" type="text/css" href="css/group.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
    <!-- <link rel="stylesheet" type="text/css" href="public/font/font-awesome/font-awesome.min.css"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    <script src="{{asset('Toastr/toastr.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('Toastr/toastr.min.css')}}">
    <!-- <script src="js/addons/rating.js"></script> -->
    <script src="ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" href="{{asset('Admin/plugins/summernote/summernote-bs4.min.css')}}">

    <script src="{{asset('Admin/plugins/summernote/summernote-bs4.min.js')}}"></script>

    <!-- REQUIRED SCRIPTS -->
    <!-- Bootstrap -->
    <script src="{{asset('Admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <!-- AdminLTE App -->
    <script src="{{asset('Admin/dist/js/adminlte.js')}}"></script>
    <link rel="stylesheet" href="{{asset('Admin/plugins/ekko-lightbox/ekko-lightbox.css')}}">
    <script src="{{asset('Admin/plugins/ekko-lightbox/ekko-lightbox.min.js')}}"></script>

    <!-- phan list frien dung template -->
    <!-- <link rel="stylesheet" href="{{asset('Admin/dist/css/adminlte.min.css')}}"> -->
    <!-- <link rel="stylesheet" href="{{asset('Admin/dist/scss/_main-sidebar.scss')}}"> -->
</head>

<body>
    <div id="site-page">
        <div id="wrapper">
            <!-- HEADER -->
            @include('layouts.header')
            <!-- END HEADER -->

            <!-- CONTENT -->
            @yield('content')
            <!-- END CONTENT -->
            <!--  -->
            <div id="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="footer-inner introduce">
                                <div class="title">
                                    <h2>giới thiệu</h2>
                                </div>
                                <div class="content">
                                    ThichPhuot là kết quả của quá trình thực hiện đề tài luận văn "Xây dựng hệ thống chia sẻ và gợi ý điểm đến dành cho du lịch phượt sử dụng Laravel Framework và Google API"
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                          
                        </div>
                        <div class="col-md-4">
                            <div class="footer-inner contact">
                                <div class="title">
                                    <h2>liên hệ</h2>
                                </div>
                                <div class="content">
                                    <ul class="method-contact">
                                        <li>
                                            <p>Địa chỉ:65 ,3/2, q.Ninh Kiều, TP.Cần Thơ</p>
                                        </li>
                                        <li>
                                            <p>Email: nguyenhoangven@gmail.com</p>
                                        </li>
                                        <li>
                                            <p>Phone: (0909.789.000)</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <!-- END FOOTER -->
            <!-- COPPY RIGHT -->
            <div id="coppy-right">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 coppyright text-center">
                            Copyright © NguyenHoangVen.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- MAIN-MENU-RESPON -->
        <div id="main-menu-respon" class="">

            <ul id="menu-respon">
                <li><a href="home">Trang Chu</a></li>
                <li><a href="">Chi tiet</a></li>
                <li class="has-sub-menu"><a href="">Diễn đàn<i class="fas fa-angle-right"></i></a>
                    <ul class="sub-menu">
                        <li><a href="">Lập team</a></li>
                        <li><a href="">Chia sẻ</a></li>
                        <li><a href="">Hỏi đáp</a></li>
                    </ul>
                </li>
                <li><a href="add-place">Thêm địa điểm</a></li>
                <li><a href="profile">Profile</a></li>
            </ul>
        </div>
    </div>
    @yield('script')
</body>

</html>