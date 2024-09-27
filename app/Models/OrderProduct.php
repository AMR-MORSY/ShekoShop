<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Option;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderProduct extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $hidden=['created_at','updated_at'];
    protected $table='order_products';

    public function order()
    {
        $this->belongsTo(Order::class);
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
