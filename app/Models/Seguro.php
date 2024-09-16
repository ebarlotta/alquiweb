<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguro extends Model
{
    use HasFactory;

    protected $fillable=[
        'estado',  // 1.Trámite completo | 2. Trámite incompleto | 3.Otro
        'vencimiento',
        'tipo',  // 1.Incendio | 2.Terceros | 3.Otro
        'observaciones',
    ];
}
