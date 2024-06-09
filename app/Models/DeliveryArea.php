<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryArea extends Model
{
    public function userAddress(){
        return $this->hasMany(Address::class,'id','delivery_area_id');
    }
}
