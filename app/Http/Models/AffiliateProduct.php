<?php

namespace App\Models;

use App\Vendor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffiliateProduct extends Model
{
    use HasFactory;
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }
    public function agentProduct(){
        return $this->belongsTo(AffiliateAgentProduct::class, 'product_id', 'product_id');
    }public function agentProducts(){
        return $this->hasMany(AffiliateAgentProduct::class, 'product_id', 'product_id');
    }
}
