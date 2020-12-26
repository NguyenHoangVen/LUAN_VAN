<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserModel;
use App\PostReviewModel;
class AdminController extends Controller
{
    // Bai viet bao cao
    public function deletePostReport(Request $request){
        PostReviewModel::find($request->post_id)->delete();
        return Response()->json(array('success'=>'ok'));
    }
    public function postReport(){
        $report_post = PostReviewModel::where('report',1)->get();
        // dd($list_post);
        return view('admin.post_report',compact('report_post'));
    }
    // Tai khoan nguoi dung
    public function index(){
    	$list_account = UserModel::all();
    	return view('admin.account',compact('list_account'));
    }
    public function deleteAccount(Request $request){
    	// UserModel::find($request->user_id)->delete();
    	$number = UserModel::all()->count();
    	return Response()->json(array('number'=>$number-1));
    }
    public function searchAaccount(){
    	$key = $_GET['key'];
    	$list_account = UserModel::where('username','like','%'.$key.'%')->get();
    	return view('admin.search_account',compact('list_account','key'));
    }
}
