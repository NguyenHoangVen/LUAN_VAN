<div class="mt-2">
    @if(isLeader(Auth::user()->id,$team->id))
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
    @endif
</div>
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
    <input type="submit" name='submit' class="update-comfirm-tool mt-2 btn btn-primary" value="Cập nhật">
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
                <input type="number" min=0 name="num_tool[{{$tool->id}}]" value="1" style="width:30px"
                    class="sl-{{$tool->id}} d-none">
                <label for="todoCheck1"></label>
            </div>
            <!-- todo text -->
            <span class="text">{{$tool->name}}</span>
            <!-- General tools such as edit or delete-->
            <div class="tools">
                <i class="fas fa-trash delete-tool" id="{{$tool->id}}">
                </i>
            </div>
        </li>
        @endforeach
    </ul>
    @if(isMemberTeam(Auth::user()->id,$team->id))
    <input type="submit" name='submit' class="comfirm-tool mt-2 btn btn-primary d-none" value="Xác nhận">
    @else
    <input type="submit" name='submit' class="comfirm-tool mt-2 btn btn-danger d-none"
        value="Bạn không có quyền bình chọn" disabled="">
    @endif
</form>
@endif