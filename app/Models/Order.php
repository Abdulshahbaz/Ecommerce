<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order_product_detail;
class Order extends Model
{
    // protected $fillable = 'razorpay_order_id';
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Order_product()
    {
        return $this->hasMany(Order_product_detail::class);
    }

}
