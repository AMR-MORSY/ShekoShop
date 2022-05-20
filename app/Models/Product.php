<?php

namespace App\Models;

use App\Models\Product_OPtion;
use App\Models\Product_Catogory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        $this->belongsTo(Product_Catogory::class);
    }

    public function product_options()
    {
        $this->hasMany(Product_OPtion::class);
    }
}
