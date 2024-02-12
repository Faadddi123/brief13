<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class drivers extends Model
{
    protected $fillable = [
        'driver_id', // Add driver_id here
    ];
    
    use HasFactory;
}
