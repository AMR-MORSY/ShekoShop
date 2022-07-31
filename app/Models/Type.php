<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Type extends Model
{
    use HasFactory;

    protected $table='types';
    protected $guarded=[];
    public function products()
    {
        return $this->hasMany(Product::class);

    }
}
