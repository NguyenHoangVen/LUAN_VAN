<?php

// == kiem tra nhom truong, cap nhat thong tin nhom truong
function checkLeader($user_id,$team_id){
    $row = \DB::table('member_team')->where('user_id',$user_id)
        ->where('team_id',$team_id)->where('level',1)->first();
    if(is_null($row)){
        return false;
    }else{
        // return true;
        if(is_null($row->fullname)){
            return true;
        }else{
            return false;
        }
    }
	// return $row;
}
function isLeader($user_id,$team_id){
    $row = \DB::table('member_team')->where('user_id',$user_id)
        ->where('team_id',$team_id)->where('level',1)->first();
    if(is_null($row)){
        return false;
    }else{
        return true;
    }
}
function infoTeamEmpty($team_id){
    $row = \DB::table('team')
        ->where('id',$team_id)->first();
    if(is_null($row->start_place)){
        return true;
    }else{
        return false;
    }
    // return $row;
}
// kiem tra xem la thanh vien nhom
function isMemberTeam($user_id,$team_id){
    $row = \DB::table('member_team')->where('user_id',$user_id)
        ->where('team_id',$team_id)->first();
    if(is_null($row)){
        return false;
    }else{
        return true;
    }
}
// Kiem tra xem da co binh chon tren nhom chua
function checkVoted($team_id,$user_id){
    $result = \DB::table('tool')->where('team_id',$team_id)
        ->leftJoin('comfirm_tool','comfirm_tool.tool_id','=','tool.id')->where('comfirm_tool.user_id',$user_id)
        ->select('comfirm_tool.*')->get();
    return $result;
}
// === MODULE POST SHARE===
function userCreatePostShare($post_id,$user_id){
    $row = \DB::table('post_share')->where('id',$post_id)->where('user_id',$user_id)->get();
    if(count($row) > 0){
        return true;
    }else{
        return false;
    }
}