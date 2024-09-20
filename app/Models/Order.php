<?php

namespace App\Models;

use App\Models\User;
use App\Models\Payment;
use App\Models\Government;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $hidden=['created_at','updated_at'];
    protected $table='orders';


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function order_products()
    {
        return $this->hasMany(OrderProduct::class);
    }
    public function government()
    {
        $this->belongsTo(Government::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }


}
