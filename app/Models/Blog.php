<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    public function category(){
        return $this->belongsTo(BlogCategory::class,'blog_category_id','id');
    }
    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function comments(){
        return $this->hasMany(BlogComment::class,'blog_id','id');
    }
}
