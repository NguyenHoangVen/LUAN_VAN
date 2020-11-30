<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialNetworksModel extends Model
{
    //
    protected $table = 'social_networks';
  
    public function user(){
    	return $this->belongsTo('App\UserModel','user_id','id');
    }
}
