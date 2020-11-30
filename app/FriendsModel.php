<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FriendsModel extends Model
{
    //
    protected $table = 'friends';
   
    public function user_accept(){
    	return $this->belongsTo('App\UserModel','id_user_send','id');
    }
    public function user_send(){
    	return $this->belongsTo('App\UserModel','id_user_accept','id');
    }
}
