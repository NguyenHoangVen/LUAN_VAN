@extends('admin.index')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lí chủ đề bài viết bị báo cáo</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item active">Danh sách chủ đề</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">

        <div class="container-fluid">

      
        <!-- Post report -->
        <div class="row">
          @if(count($report_topic) > 0)
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><b>Danh sách chủ đề bị báo cáo</b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">

                <table class="table table-bordered">
                  <thead>
                    <tr>
                    
                      <th style="text-align:center;">STT</th>
                      <th style="text-align:center;">Tên tiêu đề</th>
                      <th style="text-align:center;">Người dùng</th>
                      <th style="text-align:center;">Ngày đăng</th>
                      <th style="text-align:center;">Vị trí</th>
                      <th colspan="3" style="text-align:center;">Tùy chọn</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $stt = 0?>
                    @foreach($report_topic as $topic)
                    <?php $stt++?>
                    <tr class="report-topic-{{$topic->id}}">
                      <td style="text-align:center;">
                         {{$stt}}
                      </td>
                      <td style="text-align:center;">
                        <a href="topic/{{$topic->id}}" style="font-weight: bold">{{$topic->name}}</a>
                      </td>
                      <td style="text-align:center;">
                        <div class="user-block">
                          <img class="img-circle" src="{{asset('image/image_avatar')}}/{{$topic->user->avatar}}" alt="User Image">
                          <span class="username"><a href="#">{{$topic->user->username}}</a></span>
                        </div>
                      </td>
                      <td style="text-align:center;">
                        {{$topic->created_at->format('d-m-Y')}}
                      </td>
                      <td style="text-align:center;">
                        {{$topic->address}}
                      </td>

                      <td style="text-align:center;">
                       
                          <div class="btn btn-sm btn-danger" 
                           title="Các báo cáo" data-toggle='modal' data-target='#report-topic{{$topic->id}}'
                          >
                            <i class="far fa-check-square"></i>
                          </div>
                          <!-- Modal cac bao cao ve bai viet -->
                          <div id="report-topic{{$topic->id}}" class="modal fade" >
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title">Các báo cáo về bài viết</h4>
                                  <button type="button" class="close" data-dismiss="modal">X</button>
                                </div>
                                <div class="modal-body">
                                 
                                  <div class="col-12">
                                    <div class="card-footer card-comments">
                                       @foreach($topic->reports as $item)
                                      <div class="card-comment">
                                        <!-- User image -->
                                        <img class="img-circle img-sm" src="<?php checkFile($item->user->avatar) ?>">

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

                       
                      <!-- delete -->
                      <td style="text-align:center;">
                        <div class="btn btn-sm btn-warning delete-topic-report" 
                       href="" title="Xóa">
                          <i class="far fa-trash-alt"></i>
                          <input type="hidden" class="topic-id" value="{{$topic->id}}">
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
$('.delete-topic-report').on('click',function(){
    var topic_id = $(this).find('.topic-id').val();
    var r = confirm("Bạn có muốn chủ đề này?");
    if(r==true){
      $.ajax({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        url:"{{url('admin-page/delete-topic-report')}}",
        type:'post',
        dataType:'json',
        data:{topic_id:topic_id},
        success:function(data){
          if(data.success){

            $('.report-topic-'+topic_id).remove();
            toastr.success('Chủ đề đã được xóa.','',{timeOut: 1500})
            
          }
          console.log(data);
        }
      })
    }
  })
  
</script>
@endsection