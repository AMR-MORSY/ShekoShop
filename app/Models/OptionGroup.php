<?php

namespace App\Models;

use App\Models\Option;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OptionGroup extends Model
{
    use HasFactory;
    // protected $table="option_groups";

    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
