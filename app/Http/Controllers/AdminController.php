<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserModel;
use App\PostReviewModel;
use App\ReportTopicModel;
use App\TopicModel;
use Auth;
class AdminController extends Controller
{

    public function logout(){
        Auth::logout();
        return redirect('admin-page/login');
    }
    public function login(){
        return view('admin.login');
    }
    public function postLogin(Request $request){
        
        $data = array(
            'email' => $request->email,
            'password' => $request->password,
        );

        if(Auth::attempt($data)){
            return redirect('admin-page');
        }else{
            return redirect('admin-page/login')->with('error','Tài khoản hoặc mật khẩu không đúng');
        }
    }
    public function deleteTopic(Request $request){
        TopicModel::where('id',$request->topic_id)->delete();
        return Response()->json(array('success'=>'ok'));
    }
    public function topicReport(){
        $report_topic = TopicModel::where('report',1)->get();
        return view('admin.topic_report',compact('report_topic'));
    }
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
    	$list_account = UserModel::where('id','!=',Auth::user()->id)->get();
    	return view('admin.account',compact('list_account'));
    }
    public function deleteAccount(Request $request){
    	UserModel::find($request->user_id)->delete();
    	$number = UserModel::all()->count();
    	return Response()->json(array('number'=>$number-1));
    }
    public function searchAaccount(){
    	$key = $_GET['key'];
    	$list_account = UserModel::where('username','like','%'.$key.'%')->get();
    	return view('admin.search_account',compact('list_account','key'));
    }
}
