<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function delivery_area(){
        return $this->belongsTo(DeliveryArea::class);
    }
    public function user_address(){
        return $this->belongsTo(Address::class,'address_id','id');
    }
    public function order_item(){
        return $this->hasMany(OrderItem::class);
    }
}
