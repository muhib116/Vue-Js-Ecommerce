<?php

namespace App\Models;

use App\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingTask extends Model
{
    use HasFactory;

    public function workingTaskUsers(){
        return $this->hasMany(workingTaskUser::class, 'task_id', 'id');
    }
    public function workingTaskFrom(){
        return $this->belongsTo(Admin::class, 'assign_by');
    }

    public function taskConversations(){
        return $this->hasMany(workingTaskConversation::class, 'task_id', 'id');
    }
}
