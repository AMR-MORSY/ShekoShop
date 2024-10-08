<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Government;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class State extends Model
{
    use HasFactory;
    protected $table="states";

    public function government()
    {
        $this->belongsTo(Government::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
