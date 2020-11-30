<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InviteFriendModel extends Model
{
    //
    protected $table = 'invite_friend';
    public function send_request(){
    	return $this->belongsTo('App\UserModel','id_send','id');
    }
    public function receive_request(){
    	return $this->belongsTo('App\UserModel','id_receive','id');
    }
}
