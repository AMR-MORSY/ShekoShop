<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product_Catogory extends Model
{
    use HasFactory;
    protected $table = 'product_catogories';

    public function products()
    {
        $this->hasMany(Product::class);
        
    }
}
