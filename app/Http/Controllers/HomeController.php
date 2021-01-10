<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TopicModel;
use App\RegionModel;
use Auth;
class HomeController extends Controller
{
    //
    public function khoangCach(){
        load('Helpfunction','lib');
        $a = getDistanceBetweenPointsNew(9.764710, 105.693318, 9.803264, 105.657773, $unit='Km');
        dd($a);
    }

    public function home_view(){
        load('Helpfunction','rating');
        // $projects = \DB::table('topic')
        //     ->select('topic.*',\DB::raw('avg(num_star) as avg_star'))
        //     ->join('rating_topic', 'topic.id', '=', 'rating_topic.topic_id')
        //     ->groupBy('rating_topic.topic_id')
        //     ->orderByDesc('avg_star')
        //     ->get()->take(1);
        
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