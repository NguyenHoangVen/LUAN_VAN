<div class="col-12" style="min-height:60px">
    <input type="hidden" name="checkin_location" class="checkin-location">
    <textarea name="content" class="content" class="w-100" rows="5"
        placeholder="Hôm nay bạn thế nào...">{{$post_share->content}}</textarea>
</div>

<!-- Image review -->
<div class="col-12 mt-2">

    <div class="row">
        <div id="reviewimg1">
            <input type="hidden" name="numselect" class="numselect" value="1">
            <input type="hidden" name="numdelete" class="numdelete" value="1">
        </div>
        @foreach($post_share->images as $img)
        <div class="col-md-6">
            <div class="img-wrap">
                <span class="delete">x</span>
                <div class="thumb-img" style="height: 232px">
                    <img src="upload/image_post/{{$img->filename}}" alt="">
                </div>
                <!-- input hidden file name  -->
                <input type="hidden" name="filename_db" class="filename_db" value="{{$img->id}}">
            </div>
        </div>
        @endforeach
        <!-- danh sach cac id file de xoa -->
        <input type="hidden" name="list_file_id_db" class="list_file_id_db">
        <input type="hidden" name="post_share_id" value={{$post_share->id}}>

        
    </div>



</div>