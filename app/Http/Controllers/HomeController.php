<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TopicModel;
use App\RegionModel;
class HomeController extends Controller
{
    //

    public function home_view(){
       	$topic = TopicModel::all();
    	return view('home.main',compact('topic'));
    }
    // HIỂN THỊ MARKER CÁC ĐỊA ĐIỂM LÊN BẢN ĐỒ
    public function mapsInfomation(){
    	return view('home.map_infomation');
    }
   	
   	// CHI DUONG DI TREN BAN DO
   	public function mapDirection(){
   		return view('home.map_direction');
   	}
}
