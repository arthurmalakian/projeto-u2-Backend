<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    const ON_OFF = 1;
    const RGB = 2;
    const BRIGHTNESS_DEVICE = 3;

    protected $fillable = [
        'name',
        'type',
        'red',
        'green',
        'blue',
        'brightness',
        'status',
        'user_id',
    ];
}
