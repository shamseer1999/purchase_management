<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable=[
        'coupon','coupon_type','type_val_fixed','type_val_percent','valid_from','valid_to','created_by'
    ];
}
