<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alqui_propietarios extends Model
{
    use HasFactory;

    protected $fillable=[
        'persona_type',
        'persona_id',
    ];
}
