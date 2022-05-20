<?php

namespace App\Models;

use App\Models\OptionGroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Option extends Model
{
    use HasFactory;
    // protected $table='options';

     public function product_options()
    {
      return  $this->belongsTo(OptionGroup::class);
    }
}
