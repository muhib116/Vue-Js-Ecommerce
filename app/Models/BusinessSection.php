<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessSection extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function products(){
        return $this->hasMany(Product::class, 'product_id', 'id')->where('is_b2b', 1);
    }

    public function sectionItems(){
        return $this->hasMany(HomepageSectionItem::class, 'section_id');
    }
}
