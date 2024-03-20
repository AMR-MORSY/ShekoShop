<?php

namespace App\Models;

use App\Models\Product;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $table="categories";
    protected $guarded=[];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function images():MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function devision()
    {
        return $this->belongsTo(Devision::class);

    }

    protected function categoryName():Attribute
    {
        return Attribute::make(
            set: function ($value){
                return ucfirst($value);
            }
        );
    }
    protected function description():Attribute
    {
        return Attribute::make(
            set: function ($value){
                return ucfirst($value);
            }
        );
    }
}
