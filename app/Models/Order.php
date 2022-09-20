<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $table="orders";
    protected $guarded=[];


    public function products()
    {
        $this->belongsToMany(Product::class)->withTimestamps()->withPivot("quantity","size_id","color_id","price");
    }

    public function state()
    {
        return $this->belongsTo(State::class,"state_id");
    }
}
