<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentPostShareModel extends Model
{
    //
    protected $table = 'comment_post_share';
    public function user(){
    	return $this->belongsTo('App\UserModel','user_id','id');
    }
}
