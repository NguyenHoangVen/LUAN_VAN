<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationModel extends Model
{
    //
    protected $table = 'notification';
    public function user(){
    	return $this->belongsTo('App\UserModel','from_user','id');
    }
}
