<?php
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