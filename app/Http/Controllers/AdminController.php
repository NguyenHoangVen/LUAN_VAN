<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserModel;
class AdminController extends Controller
{
    //
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
