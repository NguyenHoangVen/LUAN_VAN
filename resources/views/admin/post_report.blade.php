@extends('admin.index')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lí bài viết bị báo cáo</h1>
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

        <div class="container-fluid">

      
        <!-- Post report -->
        <div class="row">
          @if(count($report_post) > 0)
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><b>Danh sách bài viết bị báo cáo</b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">

                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="text-align:center;"><input type="checkbox" id="check_all"></th>
                      <th style="text-align:center;">STT</th>
                      <th style="text-align:center;">Tên tiêu đề</th>
                      <th style="text-align:center;">Người dùng</th>
                      <th style="text-align:center;">Ngày đăng</th>
                      <th style="text-align:center;">Ngày cập nhật</th>
                      <th colspan="3" style="text-align:center;">Tùy chọn</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $stt = 0?>
                    @foreach($report_post as $post)
                    <?php $stt++?>
                    <tr class="report-post{{$post->id}}">
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
                        {{$post->updated_at->format('d-m-Y')}}
                      </td>

                      <td style="text-align:center;">
                       
                          <div class="btn btn-sm btn-danger" 
                           title="Các báo cáo" data-toggle='modal' data-target='#report-post{{$post->id}}'
                          >
                            <i class="far fa-check-square"></i>
                          </div>
                          <!-- Modal cac bao cao ve bai viet -->
                          <div id="report-post{{$post->id}}" class="modal fade" >
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title">Các báo cáo về bài viết</h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                 
                                  <div class="col-12">
                                    <div class="card-footer card-comments">
                                       @foreach($post->reports as $item)
                                      <div class="card-comment">
                                        <!-- User image -->
                                        <img class="img-circle img-sm" src="{{asset('image/image_avatar')}}/{{$item->user->avatar}}" alt="User Image">

                                        <div class="comment-text text-justify">
                                          <span class="username text-left">
                                            {{$item->user->username}}
                                            <span class="text-muted float-right">{{$item->created_at->format('d-m-Y')}}</span>
                                          </span><!-- /.username -->
                                          {{$item->content}}
                                        </div>
                                        <!-- /.comment-text -->
                                      </div>
                                      @endforeach
                                     
                                    </div>
                                  </div>
                                  
                                </div>
                              </div>
                            </div>
                          </div>
                         
                       
                      </td>

                      <td style="text-align:center;">
                        <div class="btn btn-sm btn-success" 
                        title="Xem" data-target='#view-post{{$post->id}}-detail' data-toggle='modal'>
                          <i class="fas fa-eye"></i>
                        </div>
                        <!-- Modal view post detail -->
                        <div id="view-post{{$post->id}}-detail" class="modal fade" >
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
                                      <div class="card-body text-justify">
                                        <!-- post text -->
                                        {!!$post->content!!}

                                        
                                      
                                    </div>
                                    <!-- /.card -->
                                  </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- /.Modal view post detail -->
                      </td>  
                      <!-- delete -->
                      <td style="text-align:center;">
                        <div class="btn btn-sm btn-warning delete-post-report" 
                       href="" title="Xóa">
                          <i class="far fa-trash-alt"></i>
                          <input type="hidden" class="post-id" value="{{$post->id}}">
                        </div>
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
            <div class="alert alert-default-primary w-100">Không có bài viết nào bị báo cáo</div>
          </div>
          @endif
          <!-- /.col -->
        </div>
        
       
       <!--  end bài viết đã duyệt -->
      </div>
    </section>
  </div>
@endsection
@section('script')
<script>
$('.delete-post-report').on('click',function(){
    var post_id = $(this).find('.post-id').val();
    var r = confirm("Bạn có muốn xóa bài viết này?");
    if(r==true){
      $.ajax({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        url:"{{url('admin-page/delete-post-report')}}",
        type:'post',
        dataType:'json',
        data:{post_id:post_id},
        success:function(data){
          if(data.success){

            $('.report-post'+post_id).remove();
            toastr.success('Bài viết đã được xóa.','',{timeOut: 1500})
            
          }
          console.log(data);
        }
      })
    }
  })
  
</script>
@endsection