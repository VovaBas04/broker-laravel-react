<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable=[
        'speed',
        'first_day',
        'is_run'
    ];
    protected $visible=[
        'speed',
        'first_day'
    ];
}
