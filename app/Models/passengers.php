<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class passengers extends Model
{
    protected $fillable = [
        'passenger_id', // Add passenger_id here
    ];

    use HasFactory;
}
