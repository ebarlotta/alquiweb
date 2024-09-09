<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alqui_propiedad extends Model
{
    use HasFactory;

    protected $fillable=[
        'tipopropiedad_id',
        'codigo',
    ];

}
