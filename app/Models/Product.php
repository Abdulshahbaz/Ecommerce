<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Order_product_detail;
use Illuminate\Database\Eloquent\softDeletes;
class Product extends Model
{
    use softDeletes;
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function Order_product()
    {
        return $this->hasMany(Order_product_detail::class);
    }

    protected $fillable = [
        'category_id ',
        'name',
        'slug',
        'image',
        'short_desc',
        'desc',
        'mrp',
        'price',
        'status',

    ];
}
