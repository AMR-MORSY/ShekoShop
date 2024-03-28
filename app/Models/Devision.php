<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Devision extends Model
{
    use HasFactory;

    protected $table='devisions';
    protected $guarded=[];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    public function products()
    {
        return $this->hasManyThrough(Product::class,Category::class);
    }

    public function images():MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    protected function devisionName():Attribute
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
