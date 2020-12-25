<?php

// == kiem tra nhom truong, cap nhat thong tin nhom truong
include "simple_html_dom.php";
function carwlData($city){
    $url = "https://mytour.vn/quick-search?keyword={$city}";
    $html = file_get_html($url);
    // echo $html;

    $title_name = array();
    $images = array();
    $address = array();
    $links = array();
    foreach ($html->find('.product-left-content .product-image a') as $link) {
       $links[] = $link->href;
    }
    foreach ($html->find('.product-left-content .product-image img') as $img) {
        $images[] = $img->src;
    }
    foreach ($html->find('.product-left-content .product-name') as $value) {
        $title_name[] = $value->innertext;
    }
    foreach ($html->find('.product-left-content .gray') as $value) {
        $address[] = $value->innertext;
    }
    $result = array(
        'title_name' => $title_name,
        'images' => $images,
        'address' => $address,
        'links' => $links
    );
    if(empty($images)){
        return false;
    }else{
        return $result;
    }

}
function apiTripadvisor($lat,$lng){
    $url = "http://api.tripadvisor.com/api/partner/2.0/map/{$lat},{$lng}?key=2380ee0b7c304f6eb06625ae38184c8b";
    $json = file_get_contents ($url);
    $json = json_decode ($json);
    $result = $json->data;
    return $result;
}
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
// ===HAM SELECTED===
function selected($value1,$value2){
    if($value1 == $value2){
        echo 'selected="selected"';
    }
}

