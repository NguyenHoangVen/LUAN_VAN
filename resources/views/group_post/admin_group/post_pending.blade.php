@extends('group_post.admin_group.index')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>QUẢN LÍ BÀI VIẾT CHƯA DUYỆT</h1>
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
                <h3 class="card-title"><b>Danh sách bài viết chưa duyệt</b></h3>
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

                            <!-- Modal Header -->
                                <div class="modal-header">
                                  <h4 class="modal-title">Chi tiết bài viết</h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                            <!-- Modal body -->
                                <div class="modal-body post-group">
                                  <div class="post-item">
                                <div class="info-user d-flex">
                                  <div class="image-avatar mr-3">
                                    <a href="" class="avatar d-block img-circle"><img src="{{asset('image/image_avatar')}}/{{$post->user->avatar}}" alt=""></a>
                                  </div>
                                  <div class="create">
                                    <div class="username">{{$post->user->username}}</div>
                                    <div class="time">{{$post->created_at->format('d-m-Y')}}</div>
                                  </div>
                                </div>
                                <!-- post content -->
                                <div class="post-content">
                                  <div class="title">{{$post->title}}</div>
                                  <div>{!!$post->content!!}</div>
                                  
                                </div>

                              </div>
                                <!-- comment post -->
                                
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
            <div class="alert alert-default-primary w-100">Không có bài viết nào chờ duyệt</div>
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