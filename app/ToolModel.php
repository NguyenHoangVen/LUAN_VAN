<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToolModel extends Model
{
    //
    protected $table = 'tool';
    public function team(){
    	return $this->belongsTo('App\TeamModel','team_id','id');
    }
    public function comfirm_tool(){
    	return $this->hasMany('App\ComfirmToolModel','tool_id','id');
    }
}
