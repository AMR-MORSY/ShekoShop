<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartProduct extends Model
{
    use HasFactory;

    protected $table="cart_products";
    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function size()
    {
        return $this->belongsTo(Size::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected function options():Attribute
    {
        return Attribute::make(
            set:function($values)
            {
                if($values)
                {
                   $options=[];
                    foreach($values as $value)
                    {
                        array_push($options,$value['id']);

                    }
                    return json_encode($options);
                }
            
            },
            get:function($value)
            {
                $optionsArray=json_decode($value);
                $options=[];
                if($optionsArray)
                {
                    foreach($optionsArray as $option)
                    {
                        $opt=Option::find($option);
                        array_push($options,$opt);
                    }

                    return $options;
    

                }
               



                return json_decode($optionsArray);
            }
        );

    }
}
