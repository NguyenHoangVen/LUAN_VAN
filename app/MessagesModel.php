<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessagesModel extends Model
{
    //
    protected $table = 'messages';
    public function user_send(){
    	return $this->belongsTo('App\UserModel','from','id');
    }
    public function user_receive(){
    	return $this->belongsTo('App\UserModel','to','id');
    }
}
