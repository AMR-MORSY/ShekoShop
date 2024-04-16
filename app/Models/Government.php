<?php

namespace App\Models;

use App\Models\State;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Government extends Model
{
    use HasFactory;

    protected $table="governments";

    public function states()
    {
        $this->hasMany(State::class);
    }
}
