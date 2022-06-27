<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Designation extends Model
{
    //use SoftDeletes;
    protected $guarded = [];


public function division(){
        return $this->belongsTo(Division::class, 'division_id');
    }
	
	public function staff(){
        return $this->belongsTo(Admin::class, 'designation_id');
    }
    
}
