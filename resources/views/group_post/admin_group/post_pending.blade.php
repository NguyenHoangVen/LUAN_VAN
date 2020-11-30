@extends('group_post.admin_group.index')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Contacts</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Bài viết chờ duyệt</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
      <section class="content">
      <div class="container-fluid">


        <div class="row">
          @if(count($post_pending) > 0)
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><b>QUẢN LÝ BÀI VIẾT CHƯA DUYỆT</b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">

                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="text-align:center;"><input type="checkbox" id="check_all"></th>
                      <th style="text-align:center;">STT</th>
                      <th style="text-align:center;">Tên tiêu đề</th>
                      <th style="text-align:center;">Người viết</th>
                      <th style="text-align:center;">Ngày đăng</th>
                     
                      <th colspan="3" style="text-align:center;">Tùy chọn</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $stt = 0?>
                    @foreach($post_pending as $post)
                    <?php $stt++?>
                    <tr id="" class="browse{{$post->id}}">

                      <td style="text-align:center;">
                            <input type="checkbox" class="sub_check" data-id="">
                      </td>
                      <td style="text-align:center;">
                         {{$stt}}
                      </td>
                      <td style="text-align:center;">
                        {{$post->title}}
                      </td>
                      <td style="text-align:center;">
                        <div class="user-block">
                          <img class="img-circle" src="{{asset('image/image_avatar')}}/{{$post->user->avatar}}" alt="User Image">
                          <span class="username"><a href="#">{{$post->user->username}}</a></span>
                        </div>
                      </td>
                      <td style="text-align:center;">
                        {{$post->created_at->format('d-m-Y')}}
                      </td>
                      <td style="text-align:center;">
                       
                          <div class="btn btn-sm btn-primary browse" 
                          href="" title="">
                            <i class="fas fa-check"></i>
                            <input type="hidden" class="post-id" value="{{$post->id}}">
                          </div>
                       
                      </td>

                      <td style="text-align:center;">
                        <div class="btn btn-sm btn-success" 
                       href="" role="button" data-target='#view-post-detail{{$post->id}}' data-toggle='modal'>
                          <i class="fas fa-eye"></i>
                        </div>
                        <!-- Modal view post detail -->
                        <div id="view-post-detail{{$post->id}}" class="modal fade" >
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                
                              </div>
                              <div class="modal-body">
                                 <div class="col-12">
                                    <!-- Box Comment -->
                                    <div class="card card-widget">
                                      <div class="card-header">
                                        <div class="user-block">
                                          <img class="img-circle" src="{{asset('image/image_avatar')}}/{{$post->user->avatar}}" alt="User Image">
                                          <span class="username"><a href="#">{{$post->user->username}}</a></span>
                                          <span class="description">{{$post->created_at->format('d-m-Y')}}</span>
                                        </div>
                                      
                                        <!-- /.card-tools -->
                                      </div>
                                      <!-- /.card-header -->
                                      <div class="card-body">
                                        <!-- post text -->
                                        {!!$post->content!!}

                                      </div>
                                      <!-- /.card-body -->
                                      <div class="card-footer card-comments">
                                        <div class="card-comment">
                                          <!-- User image -->
                                          <img class="img-circle img-sm" src="{{asset('Admin/dist/img/user1-128x128.jpg')}}" alt="User Image">

                                          <div class="comment-text">
                                            <span class="username">
                                              Maria Gonzales
                                              <span class="text-muted float-right">8:03 PM Today</span>
                                            </span><!-- /.username -->
                                            It is a long established fact that a reader will be distracted
                                            by the readable content of a page when looking at its layout.
                                          </div>
                                          <!-- /.comment-text -->
                                        </div>
                                        <!-- /.card-comment -->
                                        <div class="card-comment">
                                          <!-- User image -->
                                          <img class="img-circle img-sm" src="{{asset('Admin/dist/img/user1-128x128.jpg')}}" alt="User Image">

                                          <div class="comment-text">
                                            <span class="username">
                                              Nora Havisham
                                              <span class="text-muted float-right">8:03 PM Today</span>
                                            </span><!-- /.username -->
                                            The point of using Lorem Ipsum is that it hrs a morer-less
                                            normal distribution of letters, as opposed to using
                                            'Content here, content here', making it look like readable English.
                                          </div>
                                          <!-- /.comment-text -->
                                        </div>
                                        <!-- /.card-comment -->
                                      </div>
                                      
                                    </div>
                                    <!-- /.card -->
                                  </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- /.Modal view post detail -->
                      </td>  
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>

             
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          @else
          <div class="col-md-12">
            <div class="alert alert-success w-100">Không có bài viết nào chờ duyệt</div>
          </div>
          @endif
          
          <!-- /.col -->
        </div>
        
       
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->

  </div>
  

@endsection
@section('script')
<script>
  // === DUYỆT BÀI VIẾT===
  $('.browse').on('click',function(){
    var post_id = $(this).find('.post-id').val();
    $.ajax({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
      url:"{{url('group-post/browse-post')}}",
      type:'post',
      dataType:'json',
      data:{post_id:post_id},
      success:function(data){
        if(data.success){
          $('.browse'+post_id).remove();
          toastr.success('Đã duyệt bài viết','',{timeOut: 1500})
          
        }
        console.log(data);
      }
    })
    
  })
  //Click chọn tất cả các checkbox

    $('#check_all').on('click', function(e) {
     if($(this).is(':checked',true))  
     {
        $(".sub_check").prop('checked', true);  
     } else {  
        $(".sub_check").prop('checked',false);  
     }  
    });

</script>
@endsection