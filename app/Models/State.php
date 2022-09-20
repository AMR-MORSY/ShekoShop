<?php

namespace App\Models;

use App\Models\Government;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class State extends Model
{
    use HasFactory;
    protected $table='states';
    protected $guarded=[];

    public function government()
    {
        return $this->belongsTo(Government::class,"govern_id");
    }
    public function users_addresses()
    {
        return $this->hasMany(User_Address::class,"state_id");
    }
    public function orders()
    {
        return $this->hasMany(Order::class,"state_id");
    }
}
