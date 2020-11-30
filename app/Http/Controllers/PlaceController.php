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
use Auth;
use Session;
class PlaceController extends Controller
{
    // == BINH LUAN TOPIC ===
    public function commentTopic(Request $request){
        // dd($request);
        $comment = new CommentTopicModel();
        $comment->user_id = Auth::user()->id;
        $comment->topic_id = $request->topic_id;
        $comment->content = $request->content_comment;
        $comment->parent_id = 0;
        $comment->save();
        Session::flash('comment_topic_success','Đăng bài thành công!');
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
        $html_result ='<div class="child-comment">
            <div class="info-user d-flex mb-3">
            <a href="" class="avatar d-block"><img src="image/image_avatar/'.$comment->user->avatar.'" alt=""></a>
            <div class="username-time ml-3 d-flex justify-content-between w-100">
            <div><span class="time">Câu trả lời từ</span>
            <a href="" class="username">'.$comment->user->username.'</a>
            <span class="time d-flex">'.$comment->created_at->format("d-m-Y").'</span></div>
            <div class="report-follow dropdown dropleft"><i class="fas fa-ellipsis-h" data-toggle="dropdown"></i>
                    <div class="dropdown-menu ">
                        <a href="" class="dropdown-item">Bao cao noi dung</a>
                        <a href="" class="dropdown-item">Theo doi</a>
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
        // dd($post_review->topic->image[0]);
        return view('place.post_detail',compact('post_review'));
    }
    // == XEM CAC POST REVIEW VỀ MỘT ĐỊA ĐIỂM (CHỦ ĐỀ)==
    public function topicDetail($id){
        load('Helpfunction','rating');
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
        // dd($comments);
        $data = array(
            'topic' => $topic,
            'star_avg' => $star_avg,
            'star_percent' => $star_percent,
            'count_star' => $count_star,
            'ratings' => $ratings,
            'comments' => $comments
        );
        return view('place.detail',$data);
    }
    //== GET THÊM ĐỊA ĐIỂM==
    public function addPlace(){
        $region = RegionModel::all();
        // dd($region);
    	return view('place.add_place',compact('region'));  
    }

    // === POST THÊM ĐỊA ĐIỂM (TOPIC)===
    public function postAddPlace(Request $request){
       
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