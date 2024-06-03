<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentGateWaySetting extends Model
{
    use HasFactory;
    protected $fillable = ['key','value'];
}
