<?php

// Check frined
function checkFriend($user_id1,$user_id2){
	$row = \DB::table('friends')->where(function ($query) use ($user_id1,$user_id2) {
			$query->where('id_user_accept', '=', $user_id1)
				->where('id_user_send', '=', $user_id2);
		})
		->orWhere(function ($query) use ($user_id1,$user_id2) {
			$query->where('id_user_accept', '=', $user_id2)
				->where('id_user_send', '=', $user_id1);
		})->get()->count();
	if($row > 0){
		return true;
	}else{
		return false;
	}
	
}
function mailIsset($email){
	$num = \DB::table('users')->where('email',$email)->get()->count();
	if($num > 0){
		return true;
	}else{
		return false;
	}
}

// Check mail active
function checkMailActive($email){
	$num = \DB::table('users')->where([
		['email',$email],
		['is_active','1'],
	])->get()->count();
	if($num > 0){
		return true;
	}else{
		return false;
	}
}
// check active account 
function checkActiveAccount($email,$active_token){
	$num = \DB::table('users')->where([
		['email',$email],
		['active_token',$active_token]
	])->get()->count();
	if($num > 0){
		\DB::table('users')->where('email',$email)->update(['is_active'=>'1']);
		return true;
	}else{
		return false;
	}
}
function ven($email){
	\DB::table('users')->where('email',$email)->update(['is_active'=>'0']);
}