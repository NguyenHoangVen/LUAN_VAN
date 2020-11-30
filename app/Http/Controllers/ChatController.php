<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserModel;
use App\MessagesModel;
use App\Events\MessagesEvent;
use Auth;
class ChatController extends Controller
{
    //
    public function getBoxMessages($user_id){
    	$user = UserModel::find($user_id);
    	$my_id = Auth::user()->id;
    	$messages = MessagesModel::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id);
        })->oRwhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->where('to', $user_id);
        })->get();
    	return view('messages.chat',compact('user','messages'));
    	
    }
    public function chatVideo(){
    	return view('message.video');
    }
    public function sendMessage(Request $request){
    	$message = new MessagesModel();
    	$message->from = Auth::user()->id;
    	$message->to = $request->receive_id;
    	$message->content = $request->content;
    	$message->status = 0;
    	$message->save();
    	$id = $message->id;
    	$mes = MessagesModel::find($id);
    	// Tao du lieu de gui ve nguoi gui
    	$html_result = '<div class="direct-chat-msg right">
                        <div class="direct-chat-infos clearfix">
                          	<span class="direct-chat-name float-right">'.$mes->user_send->username.'</span>
                          	<span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                        </div>
                        <!-- /.direct-chat-infos -->
                        <img class="direct-chat-img" src="image/image_avatar/'.$mes->user_send->avatar.'" alt="message user image">
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text">
                          '.$mes->content.'
                        </div>
                        <!-- /.direct-chat-text -->
                  	</div>';
    	// Tao du lieu gui trong su kien messages
        // 1. Tra html ve cho nguoi nhan
        $html_receive_user = '<div class="direct-chat-msg">
		                        <div class="direct-chat-infos clearfix">
		                          	<span class="direct-chat-name float-left">'.$mes->user_send->username.'</span>
		                          	<span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
		                        </div>
		                        <img class="direct-chat-img" src="image/image_avatar/'.$mes->user_send->avatar.'" alt="message user image">
		                        <div class="direct-chat-text">
		                          	'.$mes->content.'
		                        </div>
		                        
	                      	</div>';
    	$data = array(
    		'from' => Auth::user()->id,
    		'to' => $request->receive_id,
    		'content' => $html_receive_user
    	);
    	// Tao su kien de gui du lieu den nguoi nhan
    	event(
    		$e = new MessagesEvent($data)
    	);
    	
    	return Response()->json(array('html'=>$html_result));
    }
}
