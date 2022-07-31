<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CategorySize extends Pivot
{
    use HasFactory;
    protected $guarded=[];
    protected $table='category_size';
}
