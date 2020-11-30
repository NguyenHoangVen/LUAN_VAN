<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostGroupModel extends Model
{
    //
    protected $table = 'post_group';
 
    public function user(){
    	return $this->belongsTo('App\UserModel','user_id','id');
    }
    public function group(){
    	return $this->belongsTo('App\GroupPostModel','group_id','id');
    }
    public function comments(){
    	return $this->hasMany('App\CommentPostGroupModel','post_id','id');
    }
    public function reports(){
        return $this->hasMany('App\ReportPostGroupModel','post_id','id');
    }
}
