<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\HelperClass\User;
use App\Mail\SendMail;
use App\UserModel;
use App\InviteFriendModel;
use App\FriendsModel;
use App\SocialNetworksModel;
use App\PostShareModel;
use App\NotificationModel;
use App\Events\AddFriendEvent;
use App\Events\UnfriendEvent;
use App\Events\AcceptAddFriendEvent;
use Socialite;
// use Auth;
use Illuminate\Support\Facades\Auth;
use Carbon;
Carbon\Carbon::setLocale('vi');
class UserController extends Controller
{
    //
    // ==Register==
    public function __construct(){
        $this->middleware(function ($request, $next) {
           $this->user = Auth::user();
           $this->signed_in = Auth::guest();
            if($this->user){
                $friends = FriendsModel::where('id_user_accept',$this->user->id)->orWhere('id_user_send',$this->user->id)->get();
                view()->share('friends', $friends);
            }
            return $next($request);
        });

        load('Helpfunction','user');
    }
  
    // ==== DANG NHAP BANG TAI KHOAN XA HOI====
    public function redirect($provider){
        return Socialite::driver($provider)->redirect();
    }
    public function callback($provider){
        $getInfo = Socialite::driver($provider)->user(); 
        // dd($getInfo);
        $this-> findOrCreateUser($getInfo,$provider);
        return redirect()->to('/home');
    }
    function findOrCreateUser($getInfo,$provider){
        $email = $getInfo->email;
        $social_id = SocialNetworksModel::where('social_type',$provider)
            ->where('social_id',$getInfo->id)->first();
       
        if($social_id){
            Auth::loginUsingId($social_id->user_id);
        }else{
            $user = UserModel::where('email',$email)->first();
            if(!$user){
                // Tao user, tao lien ket tai khoan xa hoi cho user
                $user = UserModel::create([
                    'email' => $email,
                    'username' => $getInfo->name,
                    'fullname' => $getInfo->name,
                    'is_active' => '1',
                    'password' => bcrypt($getInfo->name),
                    'avatar' => $getInfo->avatar,
                    
                ]);
                // Tao lien ket tai khoan xa hoi
                $social_network = new SocialNetworksModel();
                $social_network->user_id = $user->id;
                $social_network->social_type = $provider;
                $social_network->social_id = $getInfo->id;
                $social_network->save();
                Auth::loginUsingId($user->id);
            }else{
                $social_network = new SocialNetworksModel();
                $social_network->user_id = $user->id;
                $social_network->social_type = $provider;
                $social_network->social_id = $getInfo->id;
                $social_network->save();
                Auth::loginUsingId($user->id);
            }
        }



    }
    // 12. Xoa thong bao
    public function deleteNotification(Request $request){
        NotificationModel::where('id',$request->notification_id)->delete();
        return Response()->json(array('ok'=>$request->all()));
    }
    // 11. Danh dau thong bao da doc
    public function notificationUpdate(Request $request){
        $id_notifi = $request->id_notifi;
        NotificationModel::where('id',$id_notifi)->update(['is_read'=>1]);
        return Response()->json(array('ok'=>'Cap nhat thanh cong'));
    }
    // 10. Tu dong thong bao cho user
    public function notificationAction(Request $request){
        $notication = NotificationModel::where('to_user',Auth::user()->id)->get();
        $new_notification = NotificationModel::where('to_user',Auth::user()->id)
            ->where('is_read',0)->count();
        $html = '';
       
        if(count($notication) >0){
          
            foreach ($notication as $item) {
                if($item->is_read == 0){
                    $is_read = '';
                }else{
                    $is_read = 'is-read';
                }
                $html .='<div class="notifi-item notification'.$item->id.'"><a href="'.$item->link.'" class="dropdown-item">
                    <input type="hidden" class="notification_id" value="'.$item->id.'">
                    <div class="media">
                        <img src="image/image_avatar/'.$item->user->avatar.'" 
                            class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title '.$is_read.'">
                            '.$item->user->username.'
                            </h3>
                            <p class="text-sm '.$is_read.'">'.$item->content.'</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>'.Carbon\Carbon::parse($item->created_at)->diffForHumans().'</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown dropdown-delete">
                <i class="fas fa-ellipsis-h"></i>
                <input type="hidden" class="notification_id" value="'.$item->id.'">
                </div>
                </div>
                <div class="dropdown-divider"></div>';
            }
        }else{
            $html .= '<a class="dropdown-item dropdown-footer">Không có thông báo</a>';
        }
        return Response()->json(array('number'=>$new_notification,'html'=>$html));
    }
    // 9. Lay tab ban be co the quen biet
    public function friendSuggestions(){
        $list_user = UserModel::where('id','!=',Auth::user()->id)->get();

        
        return view('user.friend_sug',compact('list_user'));
    }
    // ========TRANG CA NHAN CUA NGUOI DUNG KHAC=======
    // 8. Xem trang cac nhan, ban be cua nguoi khac
    public function frinedAccountUser($user_id){
        $user = UserModel::find($user_id);
       
        // $list_user = UserModel::where('id','!=',$user_id)->get();
        $friend_of_user = $friends = FriendsModel::where('id_user_accept',$user_id)
            ->orWhere('id_user_send',$user_id)->get();
        // dd($friend_of_user);
        return view('user.account_friends',compact('user','friend_of_user'));
    }
    // 7.Xem trang ca nhan, bai viet cua nguoi khac
    public function infoAccountUser($user_id){
        $user = UserModel::find($user_id);
        // 1. Bai viet cua user (status)
        $posts = PostShareModel::where('user_id',$user_id)->orderBy('created_at','DESC')->get(); 
        $data = array(
            'user' => $user,
            'posts' => $posts
        );
        return view('user.account_post',$data);
    }
    // ======PROFILE USER======
    // 1. thong tin ca nhan, trang chu
    public function profileUser($user_id){
        $user = UserModel::find($user_id);
        // 1. Bai viet cua user (status)
        $posts = PostShareModel::where('user_id',$user_id)->orderBy('created_at','DESC')->get(); 
        $data = array(
            'user' => $user,
            'posts' => $posts
        );
        return view('user.profile',$data);
    }
    // 2. Thong tin ve cac bai post tren dien dan cua user
    public function userForum($user_id){
        $user = UserModel::find($user_id);
        return view('user.forum',compact('user'));
    }
    // 3. Thong tin ve cac topic user da tao
    public function userCreateTopic($user_id){
        $user = UserModel::find($user_id);
        return view('user.create_topic',compact('user'));
    }
    // 4. Thog tin ve cac bai review cua user
    public function userReviewTopic($user_id){
        $user = UserModel::find($user_id);
        return view('user.create_topic',compact('user'));
    }
    // 5. Danh sach lien quan den ban be
    public function userFriends($user_id){

        $user = UserModel::find($user_id);
        $list_user = UserModel::where('id','!=',$user_id)->get();
       
        
        return view('user.friends',compact('user','list_user'));
    }
    // 6. Tim kim ban be
    public function searchAllFriend(){
        $key = $_GET['key'];

        $list_user = UserModel::where('username','like','%'.$key.'%')
            ->where('id','!=',Auth::user()->id)
            ->get();
        return view('user.search_friend',compact('list_user'));
    }
    public function searchAllFriende(Request $request){
        $key = $request->key;
        $user = UserModel::where('username','like','%'.$key.'%')->get();
        $result = '<div class="row">';
        foreach($user as $item){
            $result .= '<div class="col-lg-6 col-md-12 mb-1">
                <div class="card">
                    <div class="card-body p-2 ">
                        <div class="respon-card">
                            <div class="d-flex">
                                <div class="avatar" style="width: 50px;height: 50px">
                                    <a href="">
                                        <img src="image/image_avatar/'.$item->avatar.'" alt="" class="w-100 h-100">
                                    </a>
                                </div>
                                <div class="username"><a  href="">'.$item->username.'</a></div>
                            </div>      
                            <div class="send mt-1"><button class="send-request btn btn-success w-100">Gửi yêu cầu</button></div>
                        </div>
                    </div>
                </div>
            </div>';
        }
        $result .= '</div>';
        return Response()->json(array('success'=>'ok','user'=>$result));
    }
    // 7. Gui yeu cau ket ban ajax, o tab ban be
    public function sendRequestAddFriend(Request $request){
        $invite = new InviteFriendModel();
        $invite->id_send = Auth::user()->id;
        $invite->id_receive = $request->receive_id;
        $invite->save();
        // Tao thong bao gui moi loi
        $notification = new NotificationModel();
        $notification->from_user = Auth::user()->id;
        $notification->to_user = $request->receive_id;
        $notification->content = "Đã gửi lời mời kết bạn";
        $notification->is_read = 0;
        $notification->link = 'user/'.$request->receive_id.'friends';
        $notification->save();
       
        return Response()->json(array('result'=>$request->all()));
    }
    // 8. Hủy yêu cầu kết bạn
    public function deleteRequestAddFriend(Request $request){
        // 1. Nguoi huy
        $id_user_delete = Auth::user()->id;
        // 2. Huy yeu cau doi voi nguoi nao
        $id_user_receive = $request->receive_id;
        InviteFriendModel::where('id_send',$id_user_delete)->where('id_receive',$id_user_receive)->delete();
       
        return Response()->json(array('result'=>$id_user_receive));
    }
    // 9. Chap nhan yeu cau ket ban
    public function acceptRequestAddFriend(Request $request){

        // 2. Insert vào bang invite (yeu cau ket ban)
        $friend = new FriendsModel();
        $friend->id_user_accept = Auth::user()->id;
        $friend->id_user_send = $request->send_id;
        $friend->save();
        // 3. Xoa bang loi moi 
        InviteFriendModel::where('id_send',$request->send_id)->where('id_receive',Auth::user()->id)->delete();
        // Tao thong bao gui moi loi
        $notification = new NotificationModel();
        $notification->from_user = Auth::user()->id;
        $notification->to_user = $request->send_id;
        $notification->content = "Đã chấp nhận lời mời kết bạn";
        $notification->is_read = 0;
        $notification->link = 'user/'.$request->send_id.'friends';
        $notification->save();
        return Response()->json(array('ok'=>'Thanh cong'));
      
       
    }
    // 10. Xoa ban be
    public function deleteFriend(Request $request){
        $user_id = Auth::user()->id;
        $friend_id = $request->friend_id;
        FriendsModel::where(function ($query) use ($friend_id,$user_id) {
            $query->where('id_user_accept', '=', $friend_id)
                  ->where('id_user_send', '=', $user_id);
        })
        ->orWhere(function ($query) use ($friend_id,$user_id) {
            $query->where('id_user_accept', '=', $user_id)
                  ->where('id_user_send', '=', $friend_id);
        })->delete();
        return Response()->json(array('ok'=>'Da xoa'));
    }
    // 11. Lay tab ban be
    public function getTabFriends(Request $request){
      
        $status = $request->status;
        // Yeu cau ket ban da nhan
        if($status == 'request'){
            $list_request = InviteFriendModel::where('id_receive',Auth::user()->id)->get();
            if(count($list_request) > 0){
                $html_result = '';
                foreach ($list_request as $user) {
                    $html_result .='<div class="col-lg-6 col-md-12 mb-1 friend-'.$user->send_request->id.'">
                        <div class="card">
                        <div class="card-body p-2 ">
                        <div class="respon-card">
                        <div class="d-flex">
                            <div class="avatar" style="width: 50px;height: 50px">
                                <a href="">
                                    <img src="image/image_avatar/'.$user->send_request->avatar.'" alt="" class="w-100 h-100">
                                </a>
                            </div>
                            <div class="username"><a  href="">'.$user->send_request->username.'</a></div>
                        </div>      
                        <div class="send mt-1"><button class="btn btn-success w-100 received-request">Chấp nhận
                        <input type="hidden" class="send_id" value="'.$user->send_request->id.'">
                        </button></div>

                        </div>
                        </div>
                        </div>
                    </div>';
                }
                return Response()->json(array('ok'=>'dgdgdg','html_result'=>$html_result));
            }else{
                $html_result = '<div class="alert alert-info">Không có yêu cầu kết bạn nào</div>';
                return Response()->json(array('ok'=>'dgdgdg','html_result'=>$html_result));
            }
           
        }

        // Yeu cau ket ban da gui
        if($status == 'sended'){
            $list_request = InviteFriendModel::where('id_send',Auth::user()->id)->get();
            if(count($list_request) > 0){
                $html_result = '';
                foreach ($list_request as $user) {
                    $html_result .='<div class="col-lg-6 col-md-12 mb-1 friend-'.$user->receive_request->id.'">
                        <div class="card">
                        <div class="card-body p-2 ">
                        <div class="respon-card">
                        <div class="d-flex">
                        <div class="avatar" style="width: 50px;height: 50px">
                            <a href="">
                                <img src="image/image_avatar/'.$user->receive_request->avatar.'" alt="" class="w-100 h-100">
                            </a>
                        </div>
                        <div class="username"><a  href="">'.$user->receive_request->username.'</a></div>
                        </div>      
                        <div class="send mt-1"><button class="btn btn-danger w-100 delete-request">Huy
                        <input type="hidden" class="receive_id" value="'.$user->receive_request->id.'">
                        </button></div>
                        </div>
                        </div>
                        </div>
                    </div>';
                }
                return Response()->json(array('ok'=>'dgdgdg','html_result'=>$html_result));
            }else{
                $html_result = '<div class="alert alert-info">Không có yêu cầu nào đã gửi</div>';
                return Response()->json(array('ok'=>'dgdgdg','html_result'=>$html_result));
            }
        }
        // Lay ra ban be cua minh
        if($status == 'all-friend'){
            $user_id = Auth::user()->id;
            $friends = FriendsModel::where('id_user_accept',$user_id)->orWhere('id_user_send',$user_id)->get();
             if(count($friends) > 0){
                $html_result = '';
                foreach ($friends as $user) {
                    if($user->id_user_accept == $user_id){
                        $html_result .='<div class="col-lg-6 col-md-12 mb-1 friend-'.$user->user_accept->id.'">
                        <div class="card">
                        <div class="card-body p-2 ">
                        <div class="respon-card">
                        <div class="d-flex">
                            <div class="avatar" style="width: 50px;height: 50px">
                                <a href="">
                                    <img src="image/image_avatar/'.$user->user_accept->avatar.'" alt="" class="w-100 h-100">
                                </a>
                            </div>
                            <div class="username"><a  href="">'.$user->user_accept->username.'</a></div>
                        </div>      
                        <div class="send mt-1 dropdown">
                            <button class="btn btn-light w-100" data-toggle="dropdown">Bạn bè</button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-item delete-friend">Xóa bạn <input type="hidden" class="friend-id" value="'.$user->user_accept->id.'"></div>
                            </div>
                        </div>

                        </div>
                        </div>
                        </div>
                        </div>';
                    }else{
                        $html_result .='<div class="col-lg-6 col-md-12 mb-1 friend-'.$user->user_send->id.'">
                        <div class="card">
                        <div class="card-body p-2 ">
                        <div class="respon-card">
                        <div class="d-flex">
                            <div class="avatar" style="width: 50px;height: 50px">
                                <a href="">
                                    <img src="image/image_avatar/'.$user->user_send->avatar.'" alt="" class="w-100 h-100">
                                </a>
                            </div>
                            <div class="username"><a  href="">'.$user->user_send->username.'</a></div>
                        </div>      
                        <div class="send mt-1 dropdown">
                            <button class="btn btn-light w-100" data-toggle="dropdown">Bạn bè</button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-item delete-friend">Xóa bạn <input type="hidden" class="friend-id" value="'.$user->user_send->id.'"></div>
                            </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>';
                    }
                    
                }
                return Response()->json(array('ok'=>'dgdgdg','html_result'=>$html_result));
            }else{
                $html_result = '<div class="alert alert-info">Không có bạn nào</div>';
                return Response()->json(array('ok'=>'dgdgdg','html_result'=>$html_result));
            }
           
        }

        // return Response()->json(array('ok'=>$status));

    }



    
    // ======== UPDATE IMAGE AJAX (AVATAR ,IMAGE COVER)========
    public function updateImageAjax(Request $request){
        $path_upload = public_path('image');
        $user_id = Auth::user()->id;
        if($request->has('file_avatar') && $request->has('file_cover')){
            // Validate
            $error_file = array(
                'file_avatar' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
               
            );
            $alert_error_file = array(
                'file_avatar.mimes' => 'Định dạng file không được hỗ trợ',
                'file_avatar.max' => 'Kích thước file quá lớn (>2048)'
            );

            $validator  = Validator::make($request->all(),$error_file,$alert_error_file);
           // 
            if($validator->passes()){
                 // Lay file anh, va ten anh
                $file_avatar = $request->file_avatar;
                $file_cover = $request->file_cover;
                $file_avatar_name = $file_avatar->getClientOriginalName();
                $file_cover_name = $file_cover->getClientOriginalName();
                // Di chuyen file vao thu muc upload
                $file_cover->move($path_upload.'/image_cover',$file_cover_name);
                $file_avatar->move($path_upload.'/image_avatar',$file_avatar_name);
                // Câp nhat vao DB
               
                \DB::table('users')->where('id',Auth::user()->id)->update(['img_cover'=>$file_cover_name,'avatar'=>$file_avatar_name]);
                // Trả kết quả về (ten anh)
                $result = array(
                    'file_avatar'=>$file_avatar_name,
                    'file_cover'=>$file_cover_name
                );
                return Response()->json(array('success'=>'1','user_id'=>$user_id,'result'=>$result));
            }else{
                return Response()->json(array('error'=>$validation->errors()));
            }
        }else if($request->has('file_avatar')){
            $error_file = array(
                'file_avatar' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
               
            );
            $alert_error_file = array(
                'file_avatar.mimes' => 'Định dạng file không được hỗ trợ',
                'file_avatar.max' => 'Kích thước file quá lớn (>2048)'
            );
            $validation  = Validator::make($request->all(),$error_file,$alert_error_file);
            // 
            if($validation->passes()){
                 // Lây file anh, ten anh
                $file_avatar = $request->file_avatar;
                $file_avatar_name = $file_avatar->getClientOriginalName();

                // Cap nhat vao DB
                \DB::table('users')->where('id',Auth::user()->id)->update(['avatar'=>$file_avatar_name]);
                // Di chuyen file vao thu muc upload
                $file_avatar->move($path_upload.'/image_avatar',$file_avatar_name);
                // Tra ket qua ve
                $result = array('file_avatar'=>$file_avatar_name);
                return Response()->json(array('success'=>'1','user_id'=>$user_id,'result'=>$result));
            }else{
                return Response()->json(array('error'=>$validation->errors()));
            }
        }else if($request->has('file_cover')){
            // Validate
            $error_file = array(
                'file_cover' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
               
            );
            $alert_error_file = array(
                'file_cover.mimes' => 'Định dạng file không được hỗ trợ',
                'file_cover.max' => 'Kích thước file quá lớn (>2048)'
            );
            $validation  = Validator::make($request->all(),$error_file,$alert_error_file);
            if($validation->passes()){
                // Lay file anh, ten anh
                $file_cover = $request->file_cover;
                $file_cover_name = $file_cover->getClientOriginalName();

                // Cap nhat vao DB
                \DB::table('users')->where('id',Auth::user()->id)->update(['img_cover'=>$file_cover_name]);
                // Di chuyen file vao thu muc upload
                $file_cover->move($path_upload.'/image_cover',$file_cover_name);
                // Trả kết quả về
                $result = array('file_cover'=>$file_cover_name);
                return Response()->json(array('success'=>'1','user_id'=>$user_id,'result'=>$result));
            }else{
                return Response()->json(array('error'=>$validation->errors()));
            }
        }else{
            return Response()->json(array('ok'=>'nguyen haoofdsifds','result'=>$request->all()));
        }
       
    }
    // ======== UPDATE PROFILE AJAX======
    public function updateProfileAjax(Request $request){
        $path_upload = public_path('image');
        $user_id = Auth::user()->id;

        $error = array(
            'fullname' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'address' => 'required'
        );
        $alert_error = array(
            'fullname.required' => 'Fullname không được trống',
            'username.required' => 'Usernam không được trống',
            'email.required' => 'Email không được trống',
            'email.email' => 'Email không đúng định dạng',
            'address.required' => 'Địa chỉ không được trống'
        );
        // Xu li file
        $file_avatar_name = '';
         
        if($request->hasFile('file_avatar')){
            $file = $request->file_avatar;
            $file_avatar_name = $file->getClientOriginalName();
            // Tao xu li loi file
            $error_file = [
                'file_avatar' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
            ];
            $alert_error_file = [
                // 'file_avatar.image' => 'Bạn chỉ upload được file ảnh',
                'file_avatar.mimes' => 'Định dạng file không được hỗ trợ',
                'file_avatar.max' => 'Kích thước file quá lớn (>2048)'
            ];
            // Append vào các xữ lí lỗi phía trên
            $error = array_merge($error,$error_file);
            $alert_error = array_merge($alert_error,$alert_error_file);
           
        }
       
        // ======================
        $validator = Validator::make($request->all(),$error,$alert_error);
        if($validator->passes()){
            // Lấy đối tượng cũ
            $user = UserModel::find($user_id);
            // // // Cập nhật lại dữ liệu
            $user->fullname = $request->fullname;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->gender = $request->gender;
            $user->address = $request->address;
            $user->introduce = $request->introduce;
            $user->date_of_birth = $request->birthday;
            $user->save();

            // ====
            if(!empty($file_avatar_name)){               
                // Di chuyen file vao thu muc upload
                $file->move($path_upload.'/image_avatar',$file_avatar_name);
                $user->avatar = $file_avatar_name;
                $user->save();
                return Response()->json(array('success'=>'1','user_id'=>$user->id,'file'=>$file_avatar_name));
            }else{
                return Response()->json(array('success'=>'1','user_id'=>$user));
            }
            
        }else{
            return Response()->json(array('errors'=>$validator->errors()));
        }
       
        
    }
    // ======= INFO PROFILE=========
    public function viewProfileAjax(Request $request){
        $user = Auth::user();
        $result = array(
            'id' => $user->id,
            'fullname' => $user->fullname,
            'username' => $user->username,
            'email' => $user->email,
            'gender' => $user->gender,
            'date_of_birth' => $user->date_of_birth,
            'address' => $user->address,
            'avarta' => $user->avarta,
            'introduce' => $user->introduce
        );
        return Response()->json(array('result'=>$result));
    }
    // =======CHANGE PASSWORD=======
    public function changePassAjax(Request $request){
        // 1. Kiem tra nhap form rong
        $error = array(
            'password' => 'required',
            'new_password' => 'min:6',
            'password_comfirm' => 'required|same:new_password'
        );
        $alert_error = array(
            'password.required' => 'Password không được trống',
            'new_password.min' => 'Mật khẩu mới ít nhất 6 kí tự',
            'password_comfirm.required' => 'Bạn chưa nhập lại mật khẩu mới',
            'password_comfirm.same' => 'Xác nhận mật khẩu mới không đúng'
        );
        // 2. Kiem tra mat khau cu khong khop
        $password_old = $request->password;
        $validator = Validator::make($request->all(),$error,$alert_error);
        if(Hash::check($password_old,Auth::user()->password)){
            
            if($validator->passes()){
                \DB::table('users')->where('id',Auth::user()->id)->update(['password'=>bcrypt($request->new_password)]);
                return Response()->json(array('status'=>'ok','success'=>'1'));
                // Cap nhat lai mat khau

            }else{
                return Response()->json(array('status'=>'ok','ok'=>$request->all(),'errors'=>$validator->errors()));
            }
            

        }else{
           
            return Response()->json(array('status'=>'no','ok'=>$request->all(),'errors'=>$validator->errors()));
        }
        

        // ==============================================
        
    }
    // =======FORGOT PASSWORD=======
    public function getForgotPass(){
        return view('user.forgot_pass');
    }
    public function postForgotPass(Request $request){
        // dd($request);
        if(mailIsset($request->email)){
            // 1.Tao random chuoi so active_tokent
            $active_token = random_int(100000,999999);
            \DB::table('users')->where('email',$request->email)->update(['active_token'=>$active_token]);

            $details = [
                'title' => 'QUÊN MẬT KHẨU TÀI KHOẢN',
                'body' => 'Xin chao ban! Đây là mã xác nhận lấy lại mật khẩu của bạn.',
                'active_token' => $active_token,
                'name_view' => 'forgot_pass',
            ];
            // 3. Gui mail kich hoat
            \Mail::to($request->email)->send(new SendMail($details));
            return redirect('newpass-vertifi')->with('email',$request->email);

        }else{
            return redirect()->back()->with('error','Email này chưa được đăng kí ');
        }
    }
    // ========VERTIFI NEW PASS=====
    public function getNewPassVertifi(){
        return view('user.newpass_vertifi');
    }
    public function postNewPassVertifi(Request $request){
        if(checkActiveAccount($request->email,$request->code_number)){
            return redirect('set-new-pass');
        }else{
            return redirect('forgot-pass');
        }
        // dd($request);
    }
    // ======= SET NEW PASS=====
    public function getSetNewPass(){
        return view('user.set_new_pass');
    }
    public function postSetNewPass(Request $request){
        $this->validate($request,
            [
                'password'=>'min:6',
                'password_comfirm'=>'same:password'
            ],
            [
                'password.min'=>'Password ít nhất 6 kí tự',
                'password_comfirm.same'=>'Nhập lại mật khẩu mới không đúng',
            ]);
        
        \DB::table('users')->where('email',$request->email)->update(['password'=>bcrypt($request->password)]);
        return redirect('login')->with('success','Lấy lại mật khẩu thành công');
    }
    // =======LOGIN======
    public function getLogin(){
        
        return view('user.login');
    }
    public function postLogin(Request $request){
        $data = array(
            'email' => $request->email,
            'password' => $request->password,
            'is_active' => '1',
        );

        if(Auth::attempt($data)){
            return redirect('home');
        }else{
            return redirect('login')->with('error','Tài khoản hoặc mật khẩu không đúng');
        }
        // dd($request);
    }

    // =====LOGOUT=======
    public function logout(){
        Auth::logout();
        return redirect('home');
    }
    // ======REGISTER========
    public function getRegister(){
    	return view('user.register');
    }
    public function postRegister(Request $request){
        $error = array(
            'fullname' => 'required|min:5',
            'username' => 'required|between:6,60',
            'email' => 'required|email',
            'password' => 'required|between:6,60',
            'password_comfirm' => 'required|same:password',
            'gender' => 'required',
            'birthday' => 'required',
            'address' => 'required'
        );
        $alert_error = array(
            'fullname.required' => 'Tên đầy đủ không được trống.',
            'fullname.min' => 'Tên đầy đủ ít nhất 5 kí tự',
            'username.required' => 'Tên tài khoản không được trống',
            'username.between' => 'Tên tài khoản từ 6-60 kí tự',
            'email.required' => 'Email không được trống',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Password không được trống',
            'password.between' => 'Password từ 6-60 kí tự',
            'password_comfirm.required' => 'Xác nhận mật khẩu không được trống',
            'password_comfirm.same' => 'Xác nhận mật khẩu không đúng',
            'gender.required' => 'Bạn chưa chọn giới tính',
            'birthday.required' => 'Ngày sinh không được trống',
            'address.required' => 'Địa chỉ không được trống'
        );
        if(!mailIsset($request->email)){
            $this->validate($request,$error,$alert_error);
            // tao mot doi tuong moi
            $user = new UserModel();
            $user->level = 0;
            $user->username = $request->username;
            $user->fullname = $request->fullname;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->gender = $request->gender;
            $user->date_of_birth = $request->birthday;
            $user->address = $request->address;
            $user->active_token = random_int(100000,999999);
            $user->save();
            // 1. Tao ma kich hoat
            $active_token = $user->active_token;
            // 2. Tao link gui kich hoat
         
            $details = [
                'title' => 'KICH HOAT TAI KHOAN',
                'body' => 'Xin chao ban '.$request->fullname,
                'active_token' => $active_token,
                'name_view' => 'sendmail',
            ];
            // 3. Gui mail kich hoat
            \Mail::to($request->email)->send(new SendMail($details));
            // chuyen den trang kich hoat
            return redirect('account-vertifi')
                ->with('email',$request->email)
                ->with('username',$request->username)
                ->with('password',$request->password);
        }else{
            if(checkMailActive($request->email)){
                $error1 = array('email'=>'unique:users,email');
                $alert_error1 =array('email.unique'=>'Tài khoản đã tồn tại trên hệ thống.');
                $error = array_merge($error,$error1);
                $alert_error = array_merge($alert_error,$alert_error1);
                $this->validate($request,$error,$alert_error);
            }else{
                $user = UserModel::where('email',$request->email)->first();
                $user->level = 0;
                $user->username = $request->username;
                $user->fullname = $request->fullname;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->gender = $request->gender;
                $user->date_of_birth = $request->birthday;
                $user->address = $request->address;
                $user->created_at = date("Y-m-d H:i:s", time());
                $user->updated_at = date("Y-m-d H:i:s", time());
                $user->active_token = random_int(100000,999999);
                $user->save();
                // Send mail kich hoat
                // 1. Tao ma kich hoat
                $active_token = $user->active_token;
                // 2. Tao ma gui kich hoat
               
                $details = [
                    'title' => 'KICH HOAT TAI KHOAN',
                    'body' => 'Xin chao ban '.$request->fullname,
                    'active_token' => $active_token,
                    'name_view' => 'sendmail',
                ];
                // 3. Gui mail kich hoat
                \Mail::to($request->email)->send(new SendMail($details));
                // echo 'kiem tra email kich hoat';
                // 4. Chuyen huong den tran xac minh
                return redirect('account-vertifi')
                    ->with('email',$request->email)
                    ->with('username',$request->username)
                    ->with('password',$request->password);
            }
        }
    }
    // === ACTIVE ACCOUNT======
    public function accountVertifi(){
    	return view('user.account_vertifi');
    }
    public function postAccountVertifi(Request $request){
        $this->validate($request,
            ['code_number'=>'required'],
            ['code_number.required'=>'Mã xác minh là bắt buộc']
        );
        
        if(checkActiveAccount($request->email,$request->code_number)){
            $data = array(
                'username' => $request->username,
                'password' => $request->password,
                'is_active' => '1',
            );
            if(Auth::attempt($data)){
                return redirect('home');
            }  
        }  
    }
   
}
