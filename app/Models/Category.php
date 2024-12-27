<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
use App\Models\Product;
class Category extends Model
{
    use softDeletes;
   

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    protected $fillable = [
        'category_name ',
        'slug_name ',
        'image',
        'status',
    ];
}
