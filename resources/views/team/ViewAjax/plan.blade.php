<div class="card">
    <div class="card-header bg-light">
        <h3 class="card-title">Vật dụng chuẩn bị</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body" style="display: block;">
        <div class="row">
            <!-- TAO BINH CHON -->
            <div class="col-lg-6 col-md-12">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Bình Chọn</h5>
                    </div>
                    <div class="card-body pt-1" id="tool-list">
                        @if(isLeader(Auth::user()->id,$team->id))
                        <div class="mt-2">
                            <button type="button" class="btn btn-info  create-poll mb-1"><i class="fas fa-plus"></i>Tạo
                                bình chọn</button>
                            <form action="" id="form-create-poll" class="d-none">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control name-tool" placeholder="Tên bình chọn ...">
                                    <div class="input-group-append">
                                        <button class="btn btn-success" type="submit">Tạo</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @endif
                        <?php $number = checkVoted($team->id,Auth::user()->id)?>
                        @if(count($number) > 0)
                        <!-- Form cap nhat -->
                        <form action="" method="POST" id="form-update-comfirm-tool">
                            @csrf
                            <ul class="todo-list ui-sortable" data-widget="todo-list">
                                @foreach($team->tools as $tool)
                                <li class="">
                                    <!-- drag handle -->
                                    <span class="handle ui-sortable-handle">
                                        <i class="fas fa-ellipsis-v"></i>
                                        <i class="fas fa-ellipsis-v"></i>
                                    </span>
                                    <!-- checkbox -->

                                    <div class="icheck-primary d-inline ml-2">
                                        <input type="hidden" name="team_id" value="{{$team->id}}">
                                        <input type="checkbox" value="{{$tool->id}}" name="tool[]" id="{{$tool->id}}" <?php 
                                        foreach($number as $number_item){
                                            if($tool->id == $number_item->tool_id){
                                                echo "checked=''";
                                            }
                                        }
                                        ?>>
                                        <input type="number" min=1 name="num_tool[{{$tool->id}}]" value="<?php
                                        $n = 1;
                                        foreach($number as $number_item){
                                            if($tool->id == $number_item->tool_id){
                                                $n =  $number_item->quaty;
                                            }
                                        }
                                        echo $n;
                                        ?>" style="width:30px" class="sl-{{$tool->id}} <?php
                                            $display = 'd-none';
                                            foreach($number as $number_item){
                                                if($tool->id == $number_item->tool_id){
                                                    $display = '';
                                                }
                                            }
                                            echo $display;
                                            ?>
                                            ">

                                        <label for="todoCheck1"></label>
                                    </div>
                                    <!-- todo text -->
                                    <span class="text">{{$tool->name}}</span>
                                    <!-- General tools such as edit or delete-->
                                    <div class="tools">
                                        @if(isLeader(Auth::user()->id,$team->id))
                                        <i class="fas fa-trash delete-tool" id="{{$tool->id}}">
                                        </i>
                                        @endif
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            <!-- Kiem tra thanh vien -->
                            <input type="submit" name='submit' class="update-comfirm-tool mt-2 btn btn-primary"
                                value="Cập nhật">
                        </form>
                        @else
                        <!-- Form xac nhan binh chon -->
                        <form action="" method="POST" id="form-comfirm-tool">
                            @csrf
                            <ul class="todo-list ui-sortable" data-widget="todo-list">
                                @foreach($team->tools as $tool)
                                <li class="">
                                    <!-- drag handle -->
                                    <span class="handle ui-sortable-handle">
                                        <i class="fas fa-ellipsis-v"></i>
                                        <i class="fas fa-ellipsis-v"></i>
                                    </span>
                                    <!-- checkbox -->
                                    <div class="icheck-primary d-inline ml-2">
                                        <input type="checkbox" value="{{$tool->id}}" name="tool[]" id="{{$tool->id}}">
                                        <input type="number" min=1 name="num_tool[{{$tool->id}}]" value="1"
                                            style="width:30px" class="sl-{{$tool->id}} d-none">
                                        <label for="todoCheck1"></label>
                                    </div>
                                    <!-- todo text -->
                                    <span class="text">{{$tool->name}}</span>
                                    <!-- General tools such as edit or delete-->
                                    <div class="tools">
                                        @if(isLeader(Auth::user()->id,$team->id))
                                        <i class="fas fa-trash delete-tool" id="{{$tool->id}}">
                                        </i>
                                        @endif
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            @if(isMemberTeam(Auth::user()->id,$team->id))
                            <input type="submit" name='submit' class="comfirm-tool mt-2 btn btn-primary d-none"
                                value="Xác nhận">
                            @else
                            <input type="submit" name='submit' class="comfirm-tool mt-2 btn btn-danger d-none"
                                value="Bạn không có quyền bình chọn" disabled="">
                            @endif
                        </form>
                        @endif



                    </div>
                </div>
            </div>
            <!-- THONG KE BINH CHON -->
            <div class="col-lg-6 col-md-12">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Thống kê bình chọn</h5>

                    </div>
                    <div class="card-body" id="thongkebinhchon">
                        <div class="tool">

                            @foreach($team->tools as $tool)
                            <div class="row mb-2">
                                <div class="col-12">
                                    <div class="card-title w-100 bg-light p-2" style="font-weight:bold">{{$tool->name}}
                                    </div>
                                </div>
                                @foreach($tool->comfirm_tool as $binhchon)
                                <div class="col-lg-6 col-md-12">
                                    <div class="team-item d-flex">
                                        <div class="avatar d-block mr-3"><img class="img-50"
                                                src="image/image_avatar/{{$binhchon->user->avatar}}" alt=""></div>
                                        <div class="info-desc">
                                            <div class="topic-title">
                                                <div class="title">{{$binhchon->user->username}}</div>
                                            </div>
                                            <div class="time mt-2"><b>Số lượng:{{$binhchon->quaty}}</b>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @endforeach


                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>
<!--  -->
<div class="card collapsed-card">
    <div class="card-header bg-light">
        <h3 class="card-title">Kế hoạch, lộ trình</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-plus"></i>
            </button>
        </div>

    </div>

    <div class="card-body" style="display: none;">
        @if(isLeader(Auth::user()->id,$team->id))
        <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#editTeam"><i
                class="fas fa-edit"></i> Chỉnh sửa</button>
        @endif
        @if(empty($team->content))
        <div class="alert alert-warning mt-2">Bạn cần cập nhật kế hoạch cho chuyên đi</div>
        @else
        <div class="p-2 mt-1" id="result-content-plan-team">
            {!!$team->content!!}c
        </div>
        @endif
        
    </div>

</div>