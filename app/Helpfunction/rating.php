<?php

// Ham trả về số lượng đánh giá theo sao

// Phan tram theo do dai
function percentStar($table,$filed,$foreign_id,$sum){
	$result = array();
	if($sum > 0){
		for ($i=5; $i >=1 ; $i--) { 
			$sum_sub =  \DB::table($table)->where($filed, $foreign_id)->where('num_star',$i)->sum('num_star');
			// echo $sum_sub;
			$percent = ($sum_sub*100)/$sum;
			$result[$i] = $percent;
		}
		return $result;
	}else{
		return 0;
	}
}
function countStar($table,$filed,$foreign_id){
	$result = array();
	
	for ($i=5; $i >=1 ; $i--) { 
		$sum_star =  \DB::table($table)->where($filed, $foreign_id)->where('num_star',$i)->count();
		// echo $sum_sub;
		$result[$i] = $sum_star;
	}
	return $result;
	
}
// Tong sao cua chu de
function avgStartTopic($id){
	$star_avg = \DB::table('rating_topic')
            ->where('topic_id',$id)
            ->groupBy('topic_id')
			->avg('num_star');
	if(is_null($star_avg)){
		return 0;
	}else{
		return $star_avg;
	}
	
}
// == KIEM TRA BINH LUAN CUA MINH
function checkCommentTopic($user_id,$comment_id){
	$row = \DB::table('comment_topic')->where('id',$comment_id)->where('user_id',$user_id)->count();
	if($row>0){
		return true;
	}else{
		return false;
	}
}
// == KIEM TRA DANH GIA CUA MINH
function checkRatingTopic($user_id,$rating_id){
	$row = \DB::table('rating_topic')->where('id',$rating_id)->where('user_id',$user_id)->count();
	if($row>0){
		return true;
	}else{
		return false;
	}
}
?>