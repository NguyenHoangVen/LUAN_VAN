<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopicModel extends Model
{
    //
    protected $table = 'topic';
    public function user(){
    	return $this->belongsTo('App\UserModel','user_id','id');
    }
    public function post_review(){
    	return $this->hasMany('App\PostReviewModel','topic_id','id');
    }
    public function ratings(){
    	return $this->hasMany('App\RatingTopicModel','topic_id','id');
    }
    public function comments(){
        return $this->hasMany('App\CommentTopicModel','topic_id','id');
    }
    public function images(){
    	return $this->hasMany('App\ImagesTopicModel','id_topic','id');
    }
}
