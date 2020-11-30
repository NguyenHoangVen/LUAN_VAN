<div class="row">
    <div class="col-md-4 center-webkit">
        <div class="avatar-edit">
            <img src="image/image_avatar/1542276278-405-kieu-trinh-3-1542275166-width650height433.jpg" alt=""
                class="changeSrc avatar1">
            <div class="overlay-edit"></div>
        </div>
        <p class="form-error" id="error-file-avatar"></p>

    </div>
    <div class="col-md-8">
        <form action="" id="form-update-profile-member">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" disabled=""
                    value="{{$member_team->user->username}}">
            </div>
            <div class="form-group">
                <label for="fullname">Họ và tên:</label>
                <input type="text" class="form-control" id="fullname" name="fullname" value="{{$member_team->fullname}}">
            </div>
            <p class="form-error" id="error-fullname"></p>
            <div class="form-group">
                <label for="fullname">Số điện thoại:</label>
                @if(!is_null($member_team->phone))
                <input type="number" class="form-control" id="phone" name="phone" value="0{{$member_team->phone}}">
                @else
                <input type="number" class="form-control" id="phone" name="phone" value="">
                @endif
            </div>
            <p class="form-error" id="error-phone"></p>
            @if(checkLeader(Auth::user()->id,$team->id))
            <div class="alert alert-danger">Thông tin bạn chưa đầy đủ, bạn cần phải cập nhật
                lại</div>
            @endif
            <div class="alert alert-default-info d-none">Cập nhật thông tin thành công</div>
            <input type="submit" value="Cập Nhật" class="btn btn-success">
        </form>
    </div>
</div>