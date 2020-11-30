<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupPostModel extends Model
{
    //
    protected $table = 'group_post';
    public function user(){
    	return $this->belongsTo('App\UserModel','user_id','id');
    }
   	public function posts(){
    	return $this->hasMany('App\PostGroupModel','group_id','id');
    }
}
