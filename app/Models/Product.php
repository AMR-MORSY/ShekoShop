<?php

namespace App\Models;


use App\Models\Type;

use App\Models\Color;
use App\Models\Image;
use App\Models\Category;
use App\Models\Devision;
use App\Models\ColorProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\Products\StoreProductRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function devision()
    {
        return $this->belongsTo(Devision::class);
    }
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
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

    public function setDevisionIdAttribute($value)
    {
        $devision = Devision::where('devision_name', $value)->first();
        $id = $devision->id;
        $this->attributes['devision_id'] = $id;

    }
    public function getDevisionIdAttribute($value)
    {
        $devision = Devision::find($value);
        return  $devision-> devision_name;
    }
    public function setTypeIdAttribute($value)
    {
        $type = Type::where('type_name', $value)->first();
        $id =  $type->id;
        $this->attributes['type_id'] = $id;

    }
    public function getTypeIdAttribute($value)
    {
        $type = Type::find($value);
        return  $type-> type_name;
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
