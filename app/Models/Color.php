<?php

namespace App\Models;

use App\Models\Size;
use App\Models\Product;
use App\Models\ColorProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Color extends Model
{
    use HasFactory;
     protected $table='colors';
     protected $guarded=[];
     public function products()
    {
      return  $this->belongsToMany(Product::class)->withTimestamps()->using(ColorProduct::class);;
    }
    
     public function images()
    {
      return $this->hasMany(Image::class);
    }
    

}
