<?php

namespace App\Models;

use App\Models\Size;
use App\Models\Product;
use App\Models\CategorySize;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';

    public function products()
    {
       return $this->hasMany(Product::class);
        
    }
    
    public function devisions()
    {
       return $this->hasMany(Devision::class);
        
    }
    public function sizes()
    {
      return  $this->belongsToMany(Size::class)->withTimestamps()->using(CategorySize::class);;
    }
    
}
