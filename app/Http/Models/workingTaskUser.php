<?php

namespace App\Models;

use App\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class workingTaskUser extends Model
{
    use HasFactory;
    public function taskUser(){
        return $this->belongsTo(Admin::class, 'user_id', 'id');
    }
}
