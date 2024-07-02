<?php

namespace App\Models;


use App\Models\Image;
use App\Models\Category;
use App\Models\Discount;
use App\Models\CartProduct;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table='products';
    protected $guarded=[];

    public function cart_products()
    {
        return $this->hasMany(CartProduct::class);
        
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function images():MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected function productName():Attribute
    {
        return Attribute::make(
            set:function($value)
            {
                return Str::of($value)->title();
            }
        );

    }


}
