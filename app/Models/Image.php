<?php

namespace App\Models;

use App\Models\Color;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table='images';

    public function color()
    {
     return   $this->belongsTo(Color::class);
    }
    public function product()
    {
     return   $this->belongsTo(Product::class);
    }
   
   
   
   
}
