<?php
function isCreatePost($post_id,$user_id){
	$row = \DB::table('post_review')
		->where('user_id',$user_id)
		->where('id',$post_id)->count();
	if($row > 0){
		return true;
	}else{
		return false;
	}
}
// =========
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