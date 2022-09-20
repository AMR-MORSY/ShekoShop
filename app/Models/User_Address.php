<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User_Address extends Model
{
    use HasFactory;
    protected $table='users_addresses';
    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function government()
    {
        return $this->belongsTo(Government::class,"government_id");
    }
    public function state()
    {
        return $this->belongsTo(State::class,"state_id");
    }


}
