<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=[
        'original_amount','discounted_amount','coupon_id','coupen_type','discount','created_by','order_date'
    ];
}
