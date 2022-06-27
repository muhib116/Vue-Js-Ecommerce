<?php

namespace App\Models;

use App\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class workingTaskConversation extends Model
{
    use HasFactory;

    public function conversationUser(){
        return $this->belongsTo(Admin::class, 'from_user');
    }
}
