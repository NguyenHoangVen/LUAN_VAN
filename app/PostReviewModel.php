<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostReviewModel extends Model
{
    //
    protected $table = 'post_review';
    public function user(){
    	return $this->belongsTo('App\UserModel','user_id','id');
    }
    public function topic(){
    	return $this->belongsTo('App\TopicModel','topic_id','id');
    }
    
}
