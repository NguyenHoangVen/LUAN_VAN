<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportPostTopicModel extends Model
{
    //
    protected $table = 'report_post_topic';
    public function user(){
    	return $this->belongsTo('App\UserModel','user_id','id');
    }
    public function post(){
    	return $this->belongsTo('App\PostReviewModel','post_id','id');
    }
}
