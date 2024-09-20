<?php

namespace App\Models;

use App\Models\Order;
use App\Models\State;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Government extends Model
{
    use HasFactory;

    protected $table="governments";

    public function states()
    {
       return $this->hasMany(State::class,'govern_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
