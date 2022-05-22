<?php

namespace App\Models;

use App\Models\Option;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product_OPtion extends Model
{
    use HasFactory;

    public function product()
    {
        $this->belongsTo(Product::class);
    }

    public function option()
    {
        $this->belongsTo(Option::class);
    }
}