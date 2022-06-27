<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use HasFactory;

    public $timestamps = false;
	
	 public function products(){
        return $this->hasMany(Enlist::class, 'catalog_id')->where('status', 1);
    }
	
}
