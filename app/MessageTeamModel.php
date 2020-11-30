<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageTeamModel extends Model
{
    //
    protected $table = 'messages_team';
    public function user_send(){
    	return $this->belongsTo('App\UserModel','user_id','id');
    }
}
