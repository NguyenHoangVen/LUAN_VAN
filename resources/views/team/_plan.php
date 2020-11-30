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
                        <!-- Form cap nhat -->
                        <!-- Form xac nhan binh chon -->
                        <form action="" method="POST" id="form-comfirm-tool">
                            @csrf
                            <ul class="todo-list ui-sortable" data-widget="todo-list">
                                <?php $number = checkVoted($team->id,Auth::user()->id)?>
                                @if(count($number) > 0)
                                @foreach($team->tools as $tool)

                                <li class="">
                                    <!-- drag handle -->
                                    <span class="handle ui-sortable-handle">
                                        <i class="fas fa-ellipsis-v"></i>
                                        <i class="fas fa-ellipsis-v"></i>
                                    </span>
                                    <!-- checkbox -->

                                    <div class="icheck-primary d-inline ml-2">

                                        <input type="checkbox" value="{{$tool->id}}" name="tool[]" id="{{$tool->id}}" <?php 
                                        foreach($number as $number_item){
                                            if($tool->id == $number_item->tool_id){
                                                echo "checked=''";
                                            }
                                        }
                                        ?>>
                                        <input type="number" min=0 name="num_tool[{{$tool->id}}]" value="1"
                                            style="width:30px" class="sl-{{$tool->id}} <?php
                                            $display = '';
                                            foreach($number as $number_item){
                                                if($tool->id == $number_item->tool_id){
                                                    $display = '';
                                                }else{
                                                    $display = 'd-none';
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
                                        <i class="fas fa-edit"></i>
                                        <i class="fas fa-trash-o"></i>
                                    </div>
                                </li>

                                @endforeach
                                @else
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
                                        <input type="number" min=0 name="num_tool[{{$tool->id}}]" value="1"
                                            style="width:30px" class="d-none sl-{{$tool->id}}">
                                        <label for="todoCheck1"></label>
                                    </div>

                                    <!-- todo text -->
                                    <span class="text">{{$tool->name}}</span>

                                    <!-- General tools such as edit or delete-->
                                    <div class="tools">
                                        <i class="fas fa-edit"></i>
                                        <i class="fas fa-trash-o"></i>
                                    </div>
                                </li>
                                @endforeach
                                @endif
                            </ul>

                            <!-- Kiem tra thanh vien -->
                            @if(isMemberTeam(Auth::user()->id,$team->id))
                            <?php $number = checkVoted($team->id,Auth::user()->id)?>
                            @if(count($number) > 0)

                            <input type="submit" name='submit' class="comfirm-tool mt-2 btn btn-primary d-none"
                                value="Cập nhật">
                            @else
                            <input type="submit" name='submit' class="comfirm-tool mt-2 btn btn-primary d-none"
                                value="Xác nhận">
                            @endif
                            @else
                            <input type="submit" name='submit' class="comfirm-tool mt-2 btn btn-danger d-none"
                                value="Bạn không có quyền bình chọn" disabled="">
                            @endif
                        </form>


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
                                                src="image/image_avatar/1542276278-405-kieu-trinh-3-1542275166-width650height433.jpg"
                                                alt=""></div>
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
        <h3 class="card-title">Primary Outline</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-plus"></i>
            </button>
        </div>

    </div>

    <div class="card-body" style="display: none;">
        The body of the card
    </div>

</div>