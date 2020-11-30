<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentTopicModel extends Model
{
    //
    protected $table = 'comment_topic';
    public function user(){
    	return $this->belongsTo('App\UserModel','user_id','id');
    }
    public function topic(){
    	return $this->belongsTo('App\TopicModel','topic_id','id');
    }
}
