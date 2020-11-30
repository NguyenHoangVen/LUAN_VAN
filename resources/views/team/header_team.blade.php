<div class="row">
    <div class="col-md-8 offset-md-2 mt-3 mb-3">
        <form action="{{url('team/search')}}" id='search-team'>
            <div class="input-group">
                <input type="search" class="key form-control form-control-lg" placeholder="Nhập từ khóa tìm kiếm..."
                    name="key">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-lg btn-default">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-lg-12 col-md-12">
        <div class="callout callout-info d-flex justify-content-between">
            <div class="btn">Tạo team,tìm bạn đồng hành</div>
            <div class="create-team btn btn-info text-right" data-toggle="modal" data-target="#createTeam"><i
                    class="fas fa-plus"></i> Tạo Team Mới</div>
        </div>

    </div>
</div>
<!-- popup tao team moi -->
<div id="createTeam" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tạo Team phuọt</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
                <form action="" id="create-team">
                    <div class="form-group">
                        <label for="email">Đặt tiêu cho nhóm của bạn (<span class="text-danger">*</span>)</label>
                        <p class="form-error" id="error-title"></p>
                        <input type="text" class="title-team form-control" placeholder="Nhập tiêu đề cho nhóm">

                    </div>

                    <div class="form-group">
                        <label for="content">Nội dung</label>
                        <textarea name="" id="" class="summernote" cols="30" rows="10"></textarea>
                    </div>
                    <div class="alert alert-default-info d-none">Tạo team thành công</div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success w-100" value="Tạo">

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>