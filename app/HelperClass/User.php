<?php
namespace App\HelperClass;
class User{
	public static function checkActive(){
		echo 'da thanh cong';
	}

	// check isset email
	public static function MailIsset($email){
		$num = \DB::table('users')->where('email',$email)->get()->count();
		echo $num;

	}
}