<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportPostGroupModel extends Model
{
    //
    protected $table = 'report_post_group';
    public function user(){
    	return $this->belongsTo('App\UserModel','user_id','id');
    }
    public function post(){
    	return $this->belongsTo('App\PostGroupmodel','post_id','id');
    }
}
