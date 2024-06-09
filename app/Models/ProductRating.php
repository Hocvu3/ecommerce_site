<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRating extends Model
{
    use HasFactory;
    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function products(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
