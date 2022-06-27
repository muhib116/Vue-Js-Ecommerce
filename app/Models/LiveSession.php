<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveSession extends Model
{
    use HasFactory;

    public function liveProducts(){
        return $this->hasMany(LiveSessionProduct::class, 'live_session_id');
    }
}
