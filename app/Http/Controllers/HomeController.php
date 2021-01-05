<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TopicModel;
use App\RegionModel;
use Auth;
class HomeController extends Controller
{
    //

    public function home_view(){
        load('Helpfunction','rating');
       	$topic_bac = TopicModel::where('region_id',1)->get();
        $topic_trung = TopicModel::where('region_id',2)->get();
        $topic_nam = TopicModel::where('region_id',3)->get();

        
    	return view('home.main',compact('topic_bac','topic_trung','topic_nam'));
    }
    // HIỂN THỊ MARKER CÁC ĐỊA ĐIỂM LÊN BẢN ĐỒ
    public function mapsInfomation(){
    	return view('home.map_infomation');
    }
   	
   	// CHI DUONG DI TREN BAN DO
   	public function mapDirection(){
   		return view('home.map_direction');
	   }
	//    TIM KIEM TREN MAP
	public function searchPlaceOnMap(Request $request){
		// 1. Tìm kiếm theo tiêu đề %LIKE%
		if(!empty($request->search_name)){
            $list_place = TopicModel::where('name','like','%'.$request->search_name.'%')->get();
		}
		// 2. Tìm kím xung quanh theo bán kính
        if(!empty($request->location['lat'])){
            $lat = $request->location['lat'];
            $lng = $request->location['lng'];
            
            // Query cac dia diem nam trong ban kinh
            $list_place = TopicModel::select(
                \DB::raw("*,( 
                    ROUND(
                    6371 *acos(
                        (sin(radians($lat))*sin(radians(lat)))+
                        cos(radians($lat))*cos(radians(lat))
                        *cos(radians($lng-lng))
                        
                    ),2)
                ) as KM ")
            )->having('KM','<=',50)->get(); 
        }
		
		// Return 
        if(count($list_place) > 0){
            return Response()->json(array('result'=>$list_place,'count'=>1));
        }else{
            return Response()->json(array('status'=>'K tim thay','count'=>0));
        }
		
	}
}