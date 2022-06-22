<?php

namespace App\Models;


use App\Models\Color;

use App\Models\Image;
use App\Models\Category;
use App\Models\ColorProduct;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\Products\StoreProductRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Request;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    // 
    public function setCategoryIdAttribute($value)
    {

        $category = Category::where('category_name', $value)->first();
        $id = $category->id;
        $this->attributes['category_id'] = $id;
    }
    public function getCategoryIdAttribute($value)
    {
        $category=Category::find($value);
        return $category->category_name;
    }



    public function colors()
    {
        return   $this->belongsToMany(Color::class)->withTimestamps()->using(ColorProduct::class);
    }




    public function facefront_image()
    {
        return $this->hasOne(ProductFacefrontImage::class,'product_id');
    }
}
