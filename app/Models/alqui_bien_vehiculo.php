<?php

namespace App\Models;

use Illuminate\Database\Connectors\MariaDbConnector;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alqui_bien_vehiculo extends Model
{
    use HasFactory;

    protected $fillable=[
        'patente',
        'marca',
        'modelo',
        'color',
        'chasis',
    ];
}
