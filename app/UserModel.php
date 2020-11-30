<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    //
    protected $table = 'users';
    protected $fillable = [
        'username', 'email', 'password','fullname','is_active','avatar'
    ];
    public function created_travel(){
        return $this->hasMany('App\TravelModel','user_id','id');
    }
    // thanh vien nhom
    public function groups(){ 
    	return $this->hasManyThrough('App\GroupPostModel','App\MemberGroupPostModel','user_id','group_id','id');
    	
    }
}
