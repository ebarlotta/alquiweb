<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alqui_bien_mueble extends Model
{
    use HasFactory;

    protected $fillable=[
        'nomenclatura',
        'canthabitaciones',
    ];
}
