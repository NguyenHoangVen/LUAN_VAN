<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostShareModel extends Model
{
    //
    protected $table = 'post_share';
    public function user(){
    	return $this->belongsTo('App\UserModel','user_id','id');
    }
    public function images(){
    	return $this->hasMany('App\ImgPostShareModel','post_share_id','id');
    }
    public function comments(){
    	return $this->hasMany('App\CommentPostShareModel','post_share_id','id');
    }
}
