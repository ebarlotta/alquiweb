<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alqui_moneda extends Model
{
    use HasFactory;

    protected $fillable=[
        'monedadescripcion',
        'signo',
    ];
}
