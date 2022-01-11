<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime'
    ];
}
