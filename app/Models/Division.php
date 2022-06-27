<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Division extends Model
{
    //use SoftDeletes;
    protected $guarded = [];


public function role(){
        return $this->hasMany(Role::class, 'id', 'designation_id')->where('status', 1);
    }
	
	
	public function admin(){
        return $this->belongsTo(Admin::class, 'role_id');
    }
    
}
