<?php

namespace App\Models;


use App\Models\Category;
use App\Models\CategorySize;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Size extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table='sizes';
 
  
    public function categories()
    {
      return  $this->belongsToMany(Category::class)->withTimestamps()->using(CategorySize::class);;
    }
  
  
  
  
  
  
}
