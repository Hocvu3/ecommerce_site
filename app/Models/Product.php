<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category(){
       return $this->belongsTo(Category::class);
    }
    public function productImages(){
        return $this->hasMany(ProductGallery::class);
    }
    public function productSizes(){
        return $this->hasMany(ProductSize::class);
    }
    public function productOptions(){
        return $this->hasMany(ProductOption::class);
    }
    public function productRatings(){
        return $this->hasMany(ProductRating::class,'product_id','id');
    }
}
