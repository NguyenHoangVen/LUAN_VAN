<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberGroupPostModel extends Model
{
    //
    protected $table = 'member_group_post';
    public function user(){
    	return $this->belongsTo('App\UserModel','user_id','id');
    }
   	// public function group(){
    // 	return $this->belongsTo('App\GroupPostModel','group_id','id');
    // }
}
