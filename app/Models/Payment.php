<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $guarded=[];
    protected $hidden=['created_at','updated_at'];
    protected $table='payment_methods';

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
