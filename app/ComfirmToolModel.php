<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComfirmToolModel extends Model
{
    //
    protected $table = 'comfirm_tool';
    public function user(){
    	return $this->belongsTo('App\UserModel','user_id','id');
    }
    // public function post(){
    // 	return $this->belongsTo('App\PostGroupmodel','post_id','id');
    // }
}
