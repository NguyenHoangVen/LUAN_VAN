<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportTopicModel extends Model
{
    //
    protected $table = 'report_topic';
    public function user(){
    	return $this->belongsTo('App\UserModel','user_id','id');
    }
    public function post(){
    	return $this->belongsTo('App\TopicModel','topic_id','id');
    }
}
