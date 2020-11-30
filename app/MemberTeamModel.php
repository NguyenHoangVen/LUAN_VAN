<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberTeamModel extends Model
{
    //
    protected $table = 'member_team';
    // public function members(){
    // 	return $this->hasMany('App\UserModel','team_id','id');
    // }
    public function user(){
    	return $this->belongsTo('App\UserModel','user_id','id');
    }
}
