<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffiliateAgent extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function agentProducts(){
        return $this->hasMany(AffiliateAgentProduct::class, 'agent_id', 'id');
    }

    public function orders(){
        return $this->belongsTo(OrderDetail::class, 'affiliate_agent_id');
    }
}
