<?php
function isMemberGroup($user_id,$group_id){
	$row = \DB::table('member_group_post')->where('user_id',$user_id)->where('group_id',$group_id)->count();
	if($row > 0){
		return true;
	}else{
		return false;
	}
}
function getStatusMemberGroup($user_id,$group_id){
	$status = \DB::table('member_group_post')->where('user_id',$user_id)->where('group_id',$group_id)->first()->status;
	return $status;
}

function checkMember($user_id,$group_id){
	$row = \DB::table('member_group_post')->where('user_id',$user_id)->where('group_id',$group_id)->where('status','member')->count();
	if($row > 0){
		return true;
	}else{
		return false;
	}
}