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
                    <div class="username"><a href="user/{{$item->id}}/info" target="_blank">{{$item->username}}</a></div>
                </div>
                <div class="pt-2">
                  <div class="btn bg-danger delete-account"><i class="fas fa-user"></i>   Xóa
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
<div class="col-lg-6 col-md-12 alert alert-default-primary">Không có thành viên nào từ <strong>{{$key}}</strong></div>
  
@endif