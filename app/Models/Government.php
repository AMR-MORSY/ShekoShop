<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Government extends Model
{
    use HasFactory;
    protected $table='governments';
    protected $guarded=[];

    public function states()
    {
        return $this->hasMany(State::class);
    }
}
