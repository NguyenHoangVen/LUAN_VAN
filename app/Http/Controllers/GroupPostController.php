<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GroupPostModel;
use App\MemberGroupPostModel;
use App\UserModel;
use App\PostGroupModel;
use App\NotificationModel;
use App\CommentPostGroupModel;
use App\ReportPostGroupModel;
use App\Events\CommentPostGroupEvent;
use Auth;
use Session;
class GroupPostController extends Controller
{
    // ==QUAN TRI GROUP POST===
    // Xoa nhom 
    public function deleteGroup($id){
        GroupPostModel::find($id)->delete();
        return redirect('group-post');
    }
    // Cap nhat nhom
    public function updateGroupPost(Request $request){
        $group = GroupPostModel::find($request->group_id);
        if($request->hasFile('image')){
            $filename = $_FILES['image']['name'];
            $location = $_FILES["image"]["tmp_name"];
            $group->avatar = $filename;
            move_uploaded_file($location, public_path('upload/avatar_group/').$filename);
        } 
       
        $group->name = $request->name_group;
        $group->save(); 
        return Response()->json(array('ok'=>$request->all()));
    }
    // Tat ca bai viet tren nhom
    public function allPost($group_id){
        $group = GroupPostModel::find($group_id);
        $list_post = PostGroupModel::where('group_id',$group_id)
        ->where('status',1)->paginate(3);
        
        return view('group_post.admin_group.all_post',compact('group','list_post'));

    }
    // Moi thanh vien khoi nhom
    public function leaveGroupMember(Request $request){
        MemberGroupPostModel::where('user_id',$request->user_id)
            ->where('group_id',$request->group_id)->delete();
        return Response()->json(array('ok'=>'Thanh vien da roi nhom'));
    }
    // Thanh vien trong nhom
    public function membersGroup($group_id){
        $group = GroupPostModel::find($group_id);
        $members = MemberGroupPostModel::where('group_id',$group_id)
            ->where('status','member')
            ->where('user_id','!=',Auth::user()->id)
            ->get();
        // dd($members);
            return view('group_post.admin_group.members',compact('members','group'));
    }
    // Xoa bai viet bi bao cao
    public function deletePostReport(Request $request){
        PostGroupModel::find($request->post_id)->delete();
        return Response()->json(array('success'=>'ok'));
    }
    // Duyet bai viet tren nhom
    public function browsePost(Request $request){
        PostGroupModel::where('id',$request->post_id)->update(['status'=>1]);
        return Response()->json(array('success'=>'ok'));
    }
    // Duyet yeu cau tham gia nhom
    public function acceptMember(Request $request){
        MemberGroupPostModel::where('user_id',$request->user_id)
            ->where('group_id',$request->group_id)
            ->update(['status'=>'member']);
        return Response()->json(array('ok'=>$request->group_id));
    }
    public function postReport($id){
        $group = GroupPostModel::find($id);
        $report_post = PostGroupModel::where('group_id',$group->id)->where('report',1)->get();
        // dd($report_post);
        return view('group_post.admin_group.post_report',compact('group','report_post'));
    }
    public function postPending($id){

        $group = GroupPostModel::find($id);
        $post_pending = PostGroupModel::where('group_id',$group->id)->where('status',0)->get();

        return view('group_post.admin_group.post_pending',compact('group','post_pending'));
    }
    public function adminGroup($id){
        $group = GroupPostModel::find($id);
        // dd($group->user); 
        $post_pending = PostGroupModel::where('group_id',$group->id)->where('status',0)->get();
        return view('group_post.admin_group.post_pending',compact('group','post_pending'));
    }
    // ============= NGUOI DUNG ==========
    public function leaveGroup($user_id,$group_id){
        MemberGroupPostModel::where('user_id',$user_id)->where('group_id',$group_id)->delete();
        return redirect('group-post');
    }
    public function joinGroup($id){
        $group = GroupPostModel::find($id);
        $user_join = \DB::table('member_group_post')
            ->where('member_group_post.group_id',$id)
            ->where('member_group_post.status','pending')
            ->join('users','users.id','=','member_group_post.user_id')
            ->select('users.*','member_group_post.created_at as ngaygui')
            ->get();
        // dd($user_join);
        return view('group_post.admin_group._join_group',compact('group','user_join'));
    }
    // -- Create Group--
    public function createGroupAjax(Request $request){
        if($request->hasFile('image')){
            $filename = $_FILES['image']['name'];
            $location = $_FILES["image"]["tmp_name"];
            move_uploaded_file($location, public_path('upload/avatar_group/').$filename);
        }      
        $group = new GroupPostModel();
        $group->avatar = $filename;
        $group->name = $request->name_group;
        $group->user_id = Auth::user()->id;
        $group->save();  
        // Nguoi tao nhom se la thanh vien cua nhom
        $member = new MemberGroupPostModel();
        $member->group_id = $group->id;
        $member->user_id  = Auth::user()->id;
        $member->status = 'member';
        $member->save();
        $result = array(
            'name_group'=>$request->name_group,
            'file'=>$filename,
            'group_id'=>$group->id
        );
        return Response()->json($result);
    }

    // ============= GROUP POST USER ==========
    // -- Bao cao bai viet tren nhom
    public function reportPost(Request $request){
        $report = new ReportPostGroupModel();
        $report->user_id = $request->user_report;
        $report->post_id = $request->post_id;
        $report->content = $request->content;
        $report->save();
        PostGroupModel::where('id',$request->post_id)->update(['report'=>1]);
        return Response()->json(array('success'=>'ok'));
    }
    // -- Binh luan bai viet tren nhom
    public function commentPostGroup(Request $request){
        $user_id = Auth::user()->id;
        $comment = new CommentPostGroupModel();
        $comment->parent_id = $request->parent_id;
        $comment->user_id = $request->user_comment;
        $comment->post_id = $request->post_id;
        $comment->content = $request->content;
        $comment->save();
        $idInserted = $comment->id;
        // Tao thong bao cho nguoi viet bai viet
        $user_id_create_post = PostGroupModel::where('id',$request->post_id)
            ->get(['user_id'])->first();
        if($user_id_create_post->user_id != $user_id){
            $notification = new NotificationModel();
            $notification->from_user = Auth::user()->id;
            $notification->to_user = $user_id_create_post->user_id;
            $notification->content = "Đã bình luận về bài viết của bạn";
            $notification->is_read = 0;
            $notification->link = 'group-post/detail/'.$request->group_id;
            $notification->save();
        }
        // Xu li du lieu tra ve client
        $data_html = '';
        $comment = CommentPostGroupModel::find($idInserted);
        if($request->parent_id == 0){
           
            $data_html ='<li>
                        <div class="comment-parent d-flex">
                            <div class="image-avatar mr-3">
                                <a href="" class="avatar d-block"><img src="image/image_avatar/'.$comment->user->avatar.'" alt=""></a>
                            </div>
                            <div class="content">
                                <input type="hidden" name="parent_id" name="hoangven4">
                                <h2 class="username font-15">'.$comment->user->username.'</h2>
                                <span class="font-15">'.$comment->content.'</span>
                               
                                <div class="reply">
                                   
                                    <b class="'.$idInserted.'">Tra loi<input type="hidden" name="user" value="'.$comment->user->username.'"></b>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="comment-child d-flex child-comment-'.$idInserted.'">
                            <ul>
                                <div class="input-reply">
                                    <div class="user-comment-child-'.$idInserted.'  d-none">
                                        <div class="d-flex">
                                            <div class="image-avatar mr-3">
                                                <a href="" class="avatar d-block"><img src="image/image_avatar/'.$comment->user->avatar.'" alt=""></a>
                                            </div>
                                            <!-- tra ve ket qua muon tra loi cho user nao -->
                                            <input type="text" name="comment-parent" class="input-comment user-reply-comment-'.$idInserted.'" placeholder="Nhập bình luận..." >
                                            <input type="hidden" name="post_id" class="post_id" value="'.$request->post_id.'">
                                                        <input type="hidden" class="parent_id" value="'.$idInserted.'">
                                                        <input type="hidden" class="user_comment" value="'.Auth::user()->id.'" >
                                            </div>
                                    </div>
                                </div>
                            </ul>
                            
                        </div>
                        
                    </li>';
           
        }else{
            $data_html ='<li>
                        <div class="d-flex">
                            <div class="image-avatar mr-3">
                                <a href="" class="avatar d-block"><img src="image/image_avatar/'.$comment->user->avatar.'" alt=""></a>
                            </div>
                            <div class="content">
                                <h2 class="username font-15">'.$comment->user->username.'</h2>
                                <span class="font-15">'.$comment->content.'</span>
                                <div class="reply">
                                    <!-- chen id cua binh luan cha tai class -->
                                    <b class="'.$request->parent_id.'"  onclick="">Tra loi<input type="hidden" name="user" value="'.$comment->user->username.'"></b>
                                    
                                </div>
                            </div>
                        </div>

                    </li>';
           
        }
        $result = array(
            'parent_id' =>  $request->parent_id,
            'data_html' =>  $data_html,
            'post_id'   =>  $request->post_id,
        );
        event(
            $e = new CommentPostGroupEvent($result)
        );
        return Response()->json(array('ok'=>$request->all(),'k'=>$user_id_create_post->user_id));
    }
    // -- Viet bai len nhom
    public function createPost(Request $request){
       
        $post = new PostGroupModel();
        $post->user_id = Auth::user()->id;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->group_id = $request->group_id;
        $post->save();
        Session::flash('create_post_success','Đăng bài thành công!');
        return redirect()->back();
    }

    // -- Cap nhat lai bai viet da lay
    public function updatePost(Request $request){
        $post = PostGroupModel::find($request->post_id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();
        return Response()->json(array('success'=>$request->all()));
    }
    // -- Chinh sua bai viet
    public function getPostEdit(Request $request){
        $post = PostGroupModel::find($request->post_id);
        return Response()->json(array('success'=>$post));
    }
    // -- Xoa bai viet
    public function deletePost(Request $request){
        PostGroupModel::find($request->post_id)->delete();
        return Response()->json(array('ok'=>$request->all(),'success'=>'ok'));
    }
    // -- Lay cac bai viet da dong gop
    public function editPost($group_id,$user_id){
        load('Helpfunction','group');
        $group = GroupPostModel::find($group_id);
        $list_post = PostGroupModel::where('user_id',$user_id)->where('group_id',$group_id)->orderBy('created_at','DESC')->get();
        return view('group_post.list_post',compact('group','list_post'));
    }
    public function groupPostDetail($id){
        
        load('Helpfunction','group');
       
        $group = GroupPostModel::find($id);

        $list_post = PostGroupModel::where('group_id',$id)->orderBy('created_at','DESC')->get();

        $a = PostGroupModel::where('user_id',2)->where('group_id',24)->orderBy('created_at','DESC')->get();
        // dd($group->members);
        return view('group_post.group_detail',compact('group','list_post'));  
    }
    // -- Yeu cau tham gia nhom
    public function joinGroupAjax(Request $request){
        $status_request = $request->status_request;
        $id_group = $request->id_group;
        $user_id = Auth::user()->id;
        if($status_request == 'join'){
            // insert request
            $member_group = new MemberGroupPostModel();
            $member_group->user_id = $user_id;
            $member_group->group_id = $id_group;
            $member_group->status = 'pending';
            $member_group->save();
        }else{
            $id = \DB::table('member_group_post')->where('user_id',$user_id)->where('group_id',$id_group)->first()->id;
            MemberGroupPostModel::find($id)->delete();
        }
        return Response()->json(array('ok'=>$status_request));
    }
    public function group(){
       
    	return view('group_post.group');
    }
    // -- Search group
    public function searchGroup(){

        load('Helpfunction','group');
        $key  = $_GET['key'];
        // dd(getStatusMemberGroup(Auth::user()->id,23));
        $list_group = GroupPostModel::where('name','like','%'.$key.'%')->get();
      
    	return view('group_post.search',compact('list_group'));
    }
    
    public function uploadImagePostGroupAjax(Request $request){
    	if ($_FILES['image']['name']){
    		if (!$_FILES['image']['error']) {

			    $name = md5(rand(100, 200));
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $filename = $name.'.'.$ext;
                
			    $destination = asset('upload/image_post').'/'.$filename; //change this directory
			    $location = $_FILES["image"]["tmp_name"];
                // $a = public_path('image/ven');
			    move_uploaded_file($location, public_path('upload/image_post/').$filename);
			    echo $destination; //change this URL
			    // return Response()->json(array('url'=>$name));
			} else {
			    echo $message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['image']['error'];
			}
    		
    	}
    	
    }
}
