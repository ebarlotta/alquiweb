<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alqui_rel_contrato_garante extends Model
{
    use HasFactory;

    protected $fillable=[
        'contrato_id',
        'garante_id',
        'activo',
    ];
}
