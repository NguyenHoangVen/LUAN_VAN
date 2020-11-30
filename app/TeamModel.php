<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamModel extends Model
{
    //
    protected $table = 'team';
    public function user(){
    	return $this->belongsTo('App\UserModel','user_id','id');
    }
    public function messages(){
    	return $this->hasMany('App\MessageTeamModel','team_id','id');
    }
    public function members(){
    	return $this->hasMany('App\MemberTeamModel','team_id','id');
    }
    public function tools(){
    	return $this->hasMany('App\ToolModel','team_id','id');
    }
    public function post_shares(){
    	return $this->hasMany('App\PostShareModel','team_id','id');
    }

}
