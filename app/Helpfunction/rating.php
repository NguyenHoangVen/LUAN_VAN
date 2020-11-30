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
?>