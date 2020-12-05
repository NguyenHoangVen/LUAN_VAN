<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TeamModel;
use App\MemberTeamModel;
use App\MessageTeamModel;
use App\UserModel;
use App\ToolModel;
use App\ComfirmToolModel;
use App\PostShareModel;
use App\ImgPostshareModel;
use App\CommentPostShareModel;
use Auth;
use App\Events\MessageRoom;
use App\Events\CommentPostShareEvent;
use Carbon;

class TeamController extends Controller
{
    public function __construct(){
        Carbon\Carbon::setLocale('vi');
        load('Helpfunction','team');
    }
    
    // ========= CAC BAI CHIA SE, CHECK IN TU TRONG TEAM ====
    // 23. Xoa bai viet chia se 
    public function deletePostShare($id){
       
        PostShareModel::where('id',$id)->delete();
        return redirect()->back();
    }
    // 22. Lay view content post share
    public function getViewContentPostShare($post_share_id){
        $post_share = PostShareModel::find($post_share_id);
        // dd($post_share);
        return view('team.ViewAjax.content_post_share',compact('post_share'));
    }
    // 21. Cap nhat chinh sua bai post share, check in
    public function updatePostShare(Request $request){
        // dd($request);
        $post_share = PostShareModel::find($request->post_share_id);
        $post_share->content = $request->content;
        $post_share->address = $request->checkin_location;
        $post_share->status = $request->status;
        $post_share->save();
        
        if($request->hasFile('image')){
            $path_upload = public_path('upload/image_post/');
            $countfiles = count($_FILES['image']['name']);
            // Xu li file
            $img_select = $request->file_name_image;
            $img_delete = explode(",", $request->file_delete);
            $img_delete = array_unique($img_delete);
            $img_save = array_diff($img_select,$img_delete);
            
            for($i=0;$i<$countfiles;$i++){  
                $filename = $_FILES['image']['name'][$i];
                if(in_array($filename, $img_save)){
                   
                    $name = md5(rand(100, 200));
                    $ext = pathinfo($_FILES['image']['name'][$i], PATHINFO_EXTENSION);
                    $filename = 'share'.$name.'.'.$ext;
                    move_uploaded_file($_FILES['image']['tmp_name'][$i],$path_upload.$filename);
                    // Insert image vap DB
                    $img_post_share = new ImgPostShareModel();
                    $img_post_share->post_share_id = $post_share->id;
                    $img_post_share->filename = $filename;
                    $img_post_share->save();
                } 
            }
        }

        // Xoa hinh anh
        if(!is_null($request->list_file_id_db)){
            $list_file_id = explode(',',$request->list_file_id_db);
            foreach($list_file_id as $file){
                ImgPostshareModel::where('id',$file)->delete();
            }  
        }
        return Response()->json(array('ok'=>'Cap nhat thanh cong'));
       
    }
    // 20. Binh luan tren bai chia se
    public function commentPostShare(Request $request){
        $comment = new CommentPostShareModel();
        $comment->content = $request->content;
        $comment->post_share_id = $request->post_share_id;
        $comment->user_id = Auth::user()->id;
        $comment->save();
        $html = '<div class="card-comment">
        <img class="img-circle img-sm"
            src="image/image_avatar/'.Auth::user()->avatar.'"
            alt="User Image">
        <div class="comment-text">
            <span class="username">
                '.Auth::user()->username.'
               
            </span>
            '.$request->content.'
        </div>
        </div>';
        $data = array(
            'post_share_id' =>$request->post_share_id,
            'html' => $html,
            'user_id' => Auth::user()->id
        );
        event(
            $e = new CommentPostShareEvent($data)
        );
        return Response()->json(array('ok'=>$request->all(),'html'=>$html));
    }
    // 19. Bai viet chia se, check in dia diem
    public function postCheckinShare(Request $request){
        
        $post_share = new PostShareModel();
        $post_share->content = $request->content;
        $post_share->address = $request->checkin_location;
        $post_share->status = $request->status;
        $post_share->user_id = Auth::user()->id;
        $post_share->team_id = $request->team_id;
        $post_share->save();
        
        if($request->hasFile('image')){
            $path_upload = public_path('upload/image_post/');
            $countfiles = count($_FILES['image']['name']);
            // Xu li file
            $img_select = $request->file_name_image;
            $img_delete = explode(",", $request->file_delete);
            $img_delete = array_unique($img_delete);
            $img_save = array_diff($img_select,$img_delete);
            
            for($i=0;$i<$countfiles;$i++){  
                $filename = $_FILES['image']['name'][$i];
                if(in_array($filename, $img_save)){
                   
                    $name = md5(rand(100, 200));
                    $ext = pathinfo($_FILES['image']['name'][$i], PATHINFO_EXTENSION);
                    $filename = 'share'.$name.'.'.$ext;
                    move_uploaded_file($_FILES['image']['tmp_name'][$i],$path_upload.$filename);
                    // Insert image vap DB
                    $img_post_share = new ImgPostShareModel();
                    $img_post_share->post_share_id = $post_share->id;
                    $img_post_share->filename = $filename;
                    $img_post_share->save();
                } 
            }
           
           
        }
        return Response()->json(array('ok'=>$request->all(),'success'=>'ok'));
    }
    // I. chia se bai viet cong khai
    public function postShare(){
        $post_shares = PostShareModel::all();
        return view('team._post_share',compact('post_shares'));
    }
    public function updateInfoTripTeam(Request $request){
        $team = TeamModel::find($request->team_id);
        $team->title = $request->title_trip;
        $team->start_day = $request->start_day;
        $team->end_day = $request->end_day;
        $team->start_place = $request->place_start;
        $team->end_place = $request->place_end;
        $team->id_place_start = $request->placeIdStart;
        $team->id_place_end = $request->placeIdEnd;
        $team->save();
        return Response()->json(array('ok'=>$request->all(),'success'=>$team));
    }
    // =============================================
    //                  PHAN KE HOACH
    // =============================================
    // 16. == LAY MODAL CAP NHAT TEAM ===
    public function getModalUpdateTeam(Request $request){
        $team = TeamModel::find($request->team_id);

        return Response()->json(array('team'=>$team));
    }
    // 17. Cap nhat lai ke hoach tren team,cap nhat team thong tin
    public function updateTeamPlan(Request $request){
        $team = TeamModel::find($request->team_id);
        $team->title = $request->title_team;
        $team->content = $request->content_team;
        $team->save();
        return Response()->json(array('ok' => $request->all(),'success'=>'ok'));
    }
    // ===== LAY VIEW THONG KE ====
    public function getViewThongKe($team_id){
        $team = TeamModel::find($team_id);
        return view('team.ViewAjax.thongke',compact('team'));
    }
    // ==== LAY VIEW BINH CHON ===
    public function getViewVoted($team_id){
        $team = TeamModel::find($team_id);
        // dd($team);
        return view('team.ViewAjax.voted',compact('team'));
    }
    // ===== THANH VIEN CAP NHAT LAI BINH CHON===
    public function updateComfirmToolAjax(Request $request){
        $old_comfirm_tool = checkVoted($request->team_id,Auth::user()->id);
        // Xoa truoc
        foreach($old_comfirm_tool as $old){
            ComfirmToolModel::where('user_id',Auth::user()->id)->where('tool_id',$old->tool_id)->delete();
        }
        // Insert sau
       
        $number = $request->num_tool;
        if(isset($request->tool)){
            $tool_id = $request->tool;
            foreach($tool_id as $tool_item_id){
                $comfirm = new ComfirmToolModel();
                $comfirm->user_id = Auth::user()->id;
                $comfirm->tool_id = $tool_item_id;
                $comfirm->quaty = $number[$tool_item_id];
                $comfirm->save();
            }
        }
     
        return Response()->json(array('ok'=>$request->all(),'old_comfirm'=>$old_comfirm_tool));
    }
    // ===== THANH VIEN XAC NHAN BINH CHON AJAX=== 
    public function comfirmToolAjax(Request $request){
        $tool_id = $request->tool;
        $number = $request->num_tool;
        foreach($tool_id as $tool_item_id){
            $comfirm = new ComfirmToolModel();
            $comfirm->user_id = Auth::user()->id;
            $comfirm->tool_id = $tool_item_id;
            $comfirm->quaty = $number[$tool_item_id];
            $comfirm->save();
        }

        return Response()->json(array('ok'=>$request->all()));
    }
    // ===== THANH VIEN XAC NHAN BINH CHON, VAT DUNG ===
    public function comfirmTool(Request $request){
        
        dd($request);
    }
    // ===== XOA VAT DUNG, CHUAN BI TRONG TEAM ===
    public function deleteTool(Request $request){
        ToolModel::where('id',$request->tool_id)->delete();
        return Response()->json(array('ok'=>$request->all()));
    }
    // ===== TAO VAT DUNG, CHUAN BI TROGN TEAM ====
    public function createTool(Request $request){
        $tool = new ToolModel();
        $tool->name = $request->name_tool;
        $tool->user_id = Auth::user()->id;
        $tool->team_id = $request->team_id;
        $tool->save();
        // Lay tool vua tao
        $tool_result = ToolModel::find($tool->id);
        $html = '
            <li class="">
            <span class="handle ui-sortable-handle">
                <i class="fas fa-ellipsis-v"></i>
                <i class="fas fa-ellipsis-v"></i>
            </span>
            <div class="icheck-primary d-inline ml-2">
                
                <input type="checkbox" value="'.$tool->id.'" name="tool[]" id="'.$tool->id.'">
                <input type="number" min=1 name="num_tool['.$tool->id.']" value="1"
                    style="width:30px" class="sl-'.$tool->id.' d-none">
                <label for="todoCheck1"></label>
            </div>
            <span class="text">'.$tool_result->name.'</span>
            <div class="tools">
                <i class="fas fa-edit"></i>
                <i class="fas fa-trash-o"></i>
            </div>
            </li>';
        return Response()->json(array('ok'=>$tool_result,'success'=>'ok','html'=>$html));
    }
    // ==== LAY VIEW PLAN ====
    public function getViewPlan($team_id){
        $team = TeamModel::find($team_id);
        return view('team.ViewAjax.plan',compact('team'));
    }
    // ==== LAY VIEW DANH SACH THANH VIEN ====
    public function getViewMemberTeam($team_id){
        $team = TeamModel::find($team_id);
        return view('team.ViewAjax.member_team',compact('team'));
    }
    // ==== CAP NHAT THONG TIN CA NHAN THANH VIEN===
    public function updateProfileMember(Request $request){
        MemberTeamModel::where('user_id',Auth::user()->id)->where('team_id',$request->team_id)
            ->update(['fullname'=>$request->fullname,'phone'=>$request->phone]);
        return Response()->json(array('ok'=>$request->all(),'success'=>'ok'));
    }
    // === LAY VIEW PROFILE THANH VIEN ====
    public function getViewProfileMember($team_id){
        
        $team = TeamModel::find($team_id);
        $member_team = MemberTeamModel::where('user_id',Auth::user()->id)->where('team_id',$team_id)->first();
        
        return view('team.ViewAjax.info_member',compact('team','member_team'));
    }
    // === CHAT TREN NHOM (TEAM) ===
    public function sendMessage(Request $request){
        $message = new MessageTeamModel();
        $message->content = $request->content;
        $message->user_id = Auth::user()->id;
        $message->team_id = $request->team_id;
        $message->save();
        $user = UserModel::find(Auth::user()->id);
        // tra html ve cho nguoi gui
        $html_user_send = '<div class="direct-chat-msg right">
        <div class="direct-chat-infos clearfix">
            <span class="direct-chat-name float-right">'.$user->username.'</span>
            
        </div>
        <img class="direct-chat-img"
            src="image/image_avatar/'.$user->avatar.'"
            alt="message user image">
        <div class="direct-chat-text">
            <div>'.$request->content.'</div>
            <span class="direct-chat-timestamp float-left mt-2">2:05
            </span>
        </div>
        </div>';
        // Tra ve html cho tat ca nhung nguoi trong nhom
        $html_room = ' <div class="direct-chat-msg">
        <div class="direct-chat-infos clearfix">
            <span class="direct-chat-name float-left">'.$user->username.'
            </span>
            
        </div>
        <img class="direct-chat-img"
            src="image/image_avatar/'.$user->avatar.'"
            alt="message user image">
        <div class="direct-chat-text"><div class="mb-2">'.$request->content.'</div>
        <span class="direct-chat-timestamp "> 2:06
        </span>
        </div>
        </div>';
        // Tao event gui tin nhan len phong
        $data = array(
            'user_send' =>$user->id,
            'team_id' => $request->team_id,
            'html'=>$html_room
        );
        event(
            $e = new MessageRoom($data)
        );
        return Response()->json(array('ok'=>$request->all(),'html'=>$html_user_send));
    }
    // ==== LAY VIEW CHAT ROOM ===
    public function getViewChatRooom($team_id){
        $team = TeamModel::find($team_id);
        $messages = $team->messages;
       
        return view('team.ViewAjax.chat_room',compact('messages','team_id'));
    }
    // == THAM GIA VAO TEAM==
    public function joinTeam(Request $request){
        $member_team = new MemberTeamModel();
        $member_team->fullname = $request->fullname;
        $member_team->phone = $request->phone;
        $member_team->user_id = Auth::user()->id;
        $member_team->team_id = $request->team_id;
        $member_team->save();
        return Response()->json(array('ok'=>$request->all(),'success'=>'ok'));
    }
    // == 2. CHI TIET VE TEAM ===
    public function detailTeam($id){
        $team = TeamModel::find($id);
        
        $a = infoTeamEmpty($id);
        $post_shares = PostShareModel::where('team_id',$id)->orderBy('created_at','DESC')->get();
        
        return view('team.detail',compact('team','post_shares'));
    }
    //
    public function teamIndex(){
        $teams = TeamModel::orderBy('created_at', 'DESC')->get();
        // dd($teams);
    	return view('team.index',compact('teams'));
    }
    public function searchTeam(){
        $key = $_GET['key'];
        $teams = TeamModel::where('title','like','%'.$key.'%')->get();
    	return view('team.search',compact('teams','key'));
    }
    // == 1. TAO TEAM ==
    public function createTeam(Request $request){
        $team = new TeamModel();
        $team->title = $request->title;
        $team->status = 0;
        $team->content = '';
        $team->user_id = Auth::user()->id;
        $team->save();
        // Mac dinh nguoi tao team se la truong nhom
        $member_team = new MemberTeamModel();
        $member_team->user_id = Auth::user()->id;
        $member_team->team_id = $team->id;
        $member_team->level = 1;
        $member_team->save();
        return Response()->json(array('ok'=>$request->all(),'success'=>'ok'));
    }
   
}