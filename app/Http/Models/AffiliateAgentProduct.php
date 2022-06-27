<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffiliateAgentProduct extends Model
{
    use HasFactory;

    public  function affiliateProduct(){
        return $this->belongsTo(AffiliateProduct::class, 'affiliate_product_id');
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
