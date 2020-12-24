<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\RegionModel;
use App\TopicModel;
use App\PostReviewModel;
use App\RatingTopicModel;
use App\CommentTopicModel;
use App\ImagesTopicModel;
use Auth;
use Session;
class PlaceController extends Controller
{
    // 3. Xoa binh luan ajax
    public function deleteCommentAjax(Request $request){
       
        if($request->level == 'parent'){
            CommentTopicModel::where('id',$request->id)
                ->orWhere('parent_id',$request->id)
                ->delete();
        }
        if($request->level == 'child'){
            CommentTopicModel::where('id',$request->id)
                ->delete();
        }
        return Response()->json(array('ok'=>$request->all()));
    }
    // ===DONG GOP HINH ANH CHO DIA DIEM===
    // 1. AddImages
    public function addImages(Request $request){
        if($request->hasFile('image')){
            $path_upload = public_path('image/image_place/');
            $countfiles = count($_FILES['image']['name']);
            // Xu li file
            $img_select = $request->file_name_image;
            $img_delete = explode(",", $request->file_delete);
            $img_delete = array_unique($img_delete);
            $img_save = array_diff($img_select,$img_delete);
            $topic_id = $request->topic_id;
            for($i=0;$i<$countfiles;$i++){
                $filename = $_FILES['image']['name'][$i];
                if(in_array($filename, $img_save)){
                    $name = md5(rand(100, 200));
                    $ext = pathinfo($_FILES['image']['name'][$i], PATHINFO_EXTENSION);
                    $filename = 'share'.$name.'.'.$ext;
                    // --
                   
                    move_uploaded_file($_FILES['image']['tmp_name'][$i],$path_upload.$filename);
                    $images_topic = new ImagesTopicModel();
                    $images_topic->id_topic = $topic_id;
                    $images_topic->filename = $filename;
                    $images_topic->save();
                }
                
            }
            
        }
        return Response()->json(array('ok'=>$request->all(),'success'=>'ok'));   
    }
    // == BINH LUAN TOPIC ===
    public function commentTopic(Request $request){
        // dd($request);
        $comment = new CommentTopicModel();
        $comment->user_id = Auth::user()->id;
        $comment->topic_id = $request->topic_id;
        $comment->content = $request->content_comment;
        $comment->parent_id = 0;
        $comment->save();
        Session::flash('comment_topic_success','Gửi bình luận thành công!');
        return redirect()->back();
    }
    public function commentAjax(Request $request){
        $comment = new CommentTopicModel();
        $comment->user_id = Auth::user()->id;
        $comment->topic_id = $request->topic_id;
        $comment->content = $request->content;
        $comment->parent_id = $request->parent_id;
        $comment->save();

        $idInserted = $comment->id;
        $comment = CommentTopicModel::find($idInserted);
        $html_result ='<div class="child-comment child-comment-'.$comment->id.'">
            <div class="info-user d-flex mb-3">
            <a href="" class="avatar d-block"><img src="image/image_avatar/'.$comment->user->avatar.'" alt=""></a>
            <div class="username-time ml-3 d-flex justify-content-between w-100">
            <div><span class="time">Câu trả lời từ</span>
            <a href="" class="username">'.$comment->user->username.'</a>
            <span class="time d-flex">'.$comment->created_at->format("d-m-Y").'</span></div>
            <div class="report-follow dropdown dropleft"><i class="fas fa-ellipsis-h" data-toggle="dropdown"></i>
                    <div class="dropdown-menu ">
                        
                        <a class="dropdown-item delete-comment">Xóa
                            <input type="hidden" class="hidden-comment" value="child">
                            <input type="hidden" class="hidden-comment-id" value="'.$comment->id.'">
                        </a>
                    </div>
                </div>
            </div>
            </div>
            <div class="content">
                <p>'.$comment->content.'</p>
            </div>
            </div>';
        return Response()->json(array('success'=>$request->all(),'html'=>$html_result));
    }
    // == DANH GIA TOPIC ===
    public function ratingTopic(Request $request,$id){
        $rating = new RatingTopicModel();
        $rating->user_id = Auth::id();
        $rating->topic_id = $request->topic_id;
        $rating->title = $request->title;
        $rating->content = $request->content;
        $rating->num_star = $request->num_star;
        Session::flash('rating_success','Đăng bài thành công!');
        $rating->save();
        return redirect()->back();
    }
    // == XEM CHI TIET CAC BAI POST CUA MOT TOPIC===
    public function postTopicDetail($id){
        $post_review = PostReviewModel::find($id);
        $topic_id = $post_review->topic_id;
        $post_new = PostReviewModel::where('topic_id',$topic_id)
        ->where('id','!=',$id)
        ->orderBy('created_at','desc')
        ->take(5)
        ->get();
        return view('place.post_detail',compact(['post_review','post_new']));
    }
    // == XEM CAC POST REVIEW VỀ MỘT ĐỊA ĐIỂM (CHỦ ĐỀ)==
    public function topicDetail($id){
        load('Helpfunction','rating');
        load('Helpfunction','team');
        load('Helpfunction','slug');
        // dd(checkCommentTopic(2,9));
        $sum_star = \DB::table('rating_topic')
            ->where('topic_id',$id)
            ->groupBy('topic_id')
            ->sum('num_star');

        $star_avg = \DB::table('rating_topic')
            ->where('topic_id',$id)
            ->groupBy('topic_id')
            ->avg('num_star');
        $star_percent = percentStar('rating_topic','topic_id',$id,$sum_star);
        $count_star = countStar('rating_topic','topic_id',$id);
        // dd($count_star);
        $topic = TopicModel::find($id);

        $ratings = RatingTopicModel::where('topic_id',$id)->orderBy('created_at', 'DESC')->get();
        $comments = CommentTopicModel::where('topic_id',$id)->orderBy('created_at', 'DESC')->get();
        // Goi y cac dia diem xung quanh
        // 1. Lay du lieu truyen url tim kiem
        $a = create_slug($topic->province);
        $city = str_replace('-','+',$a);
        $data_carwl = carwlData($city);//Carwl data Mytour
        // 2. Lay du lieu API TripAdvisor
        $cat_tripadvisor = array(
            'hotel' => 'Khách Sạn',
            'restaurant' => 'Nhà Hàng',
            'attraction' => 'Hoạt động'
        );
        // dd($cat_tripadvisor);
        $data_tripadvisor = apiTripadvisor($topic->lat,$topic->lng);
        // dd($data_tripadvisor);
        // Images topic
        $image_topic1 = json_decode($topic->image);
        $images_topic = ImagesTopicModel::select('filename')->where('id_topic',$topic->id)->get();
        $images_topic2 = array();
        foreach($images_topic as $img){
            $images_topic2[] = $img->filename;
        }
        $images = array_merge($image_topic1,$images_topic2);

        // 3. Cac bai post review ve toptic
        $post_review = PostReviewModel::where('topic_id',$topic->id)
            ->where('category','review')
            ->paginate(2,['*'], 'page_review');
           
        $post_review1 = PostReviewModel::where('topic_id',$topic->id)
            ->where('category','experience')
            ->paginate(2,['*'], 'page_ex');
        // 4. Bai viet moi nhat
        $post_new = PostReviewModel::where('topic_id',$topic->id)
            ->orderBy('created_at','desc')
            ->take(5)
            ->get();
        // 5. Cac dia diem khac gan do (Pham vi ban kinh)
        $lat = $topic->lat;
        $lng = $topic->lng;
        $place_near = TopicModel::where('id','!=',$id)
            ->select(
            \DB::raw("*,( 
                ROUND(
                6371 *acos(
                    (sin(radians($lat))*sin(radians(lat)))+
                    cos(radians($lat))*cos(radians(lat))
                    *cos(radians($lng-lng))
                    
                ),2)
            ) as KM ")
        )->having('KM','<=',10)->get();
    //    dd(avgStartTopic($id));
        $data = array(
            'images' => $images,
            'topic' => $topic,
            'star_avg' => $star_avg,
            'star_percent' => $star_percent,
            'count_star' => $count_star,
            'ratings' => $ratings,
            'comments' => $comments,
            'data_carwl' => $data_carwl,
            'data_tripadvisor' => $data_tripadvisor,
            'post_review' => $post_review,
            'post_review1' => $post_review1,
            'post_new' => $post_new,
            'place_near' => $place_near,
            'cat_tripadvisor' => $cat_tripadvisor,
        );
        
       
        return view('place.detail',$data);
    }
    //== GET THÊM ĐỊA ĐIỂM==
    public function addPlace(){
        $region = RegionModel::all();

    	return view('place.add_place',compact('region'));  
    }

    // === POST THÊM ĐỊA ĐIỂM (TOPIC)===
    public function postAddPlace(Request $request){
        // dd($request);
        $post = new PostReviewModel();
        $this->validate($request,
            [
                'title' => 'required',
                'content' =>'required',
                'id_topic' => 'required'
            ],
            [
                'name_topic.required' => 'Bạn chưa chọn chủ đề (địa điểm)',
                'title.required' => 'Nhập tiêu đề',
                'content.required' =>'Nhập nội dung bài viết',
                'id_topic.required' => 'Chủ đề này chưa được tạo'
            ]);
        $post->title = $request->title;
        $post->topic_id = $request->id_topic;
        $post->content = $request->content;
        $post->user_id = Auth::user()->id;
        $post->category = $request->category;
        $post->save();
        Session::flash('checkin_success','Đăng bài thành công!');
        return redirect()->back();
       
    }
    // === TÌM KIẾM NHANH (LIVE SEARCH) TOPIC===
    public function liveSearchTopic(Request $request){
        $key_word = $request->key_word;
        $topic = TopicModel::where('name','like','%'.$key_word.'%')->get();
        $result = '<ul>';
        if(count($topic)>0){
            foreach($topic as $item ){
                $image = json_decode($item->image)[0];
                $result .= '<li class="topic d-flex"><div class="image">
                 <img src="image/image_place/'.$image.'" alt="">
                 </div><div class="info"><b class="name">'.$item->name.'</b>
                 <p class="address">'.$item->address.'</p></div>
                 <input type="hidden" class="id-topic" value="'.$item->id.'"></li>';
            }
            $result .= '</ul>';
            echo $result;   
        }else{
            echo '<ul><li class="create-topic" data-toggle="modal" data-target="#addTopicPlace"><p>Địa điểm này chưa được tạo, bạn có muốn tạo địa điểm này không</p><div class="btn btn-success mt-1" id="moveTopic">Tạo</div></li></ul>';
        }
       
        // echo $result;
    }

    // === THÊM ĐỊA ĐIỂM (CHỦ ĐỀ)============
    public function addTopicAjax(Request $request){
        $topic = new TopicModel();
        $topic->name = ucwords($request->name);
        $topic->address = $request->address;
        $topic->lat = $request->lat;
        $topic->lng = $request->lng;
        $topic->user_id = Auth::user()->id;
        $topic->region_id = $request->region;
        // --
        $str = explode(",", $request->city);
        $city = $str[count($str)-2];
        $topic->province = ltrim($city," ");
        
        if($request->hasFile('image')){
            $path_upload = public_path('image/image_place/');
            $countfiles = count($_FILES['image']['name']);
            // Xu li file
            $img_select = $request->file_name_image;
            $img_delete = explode(",", $request->file_delete);
            $img_delete = array_unique($img_delete);
            $img_save = array_diff($img_select,$img_delete);
            for($i=0;$i<$countfiles;$i++){
                $filename = $_FILES['image']['name'][$i];
                if(in_array($filename, $img_save)){
                    move_uploaded_file($_FILES['image']['tmp_name'][$i],$path_upload.$filename);
                } 
            }
            $topic->image = json_encode($img_save); 
           
        }
        $topic->save();
        return Response()->json(array('ok'=>$request->all(),'success'=>'ok'));   
    }

    
    
  
}
