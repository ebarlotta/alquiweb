<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\alqui_propiedad as Propiedad;

class alqui_rel_propiedad_propietario extends Model
{
    use HasFactory;

    protected $fillable=[
        'propiedad_id',
        'porcentaje',
        'persona_type',
        'persona_id',
        'activo',
    ];

    // Si tienes timestamps personalizados o no los usas, puedes ajustar esto
    public $timestamps = true;
    
    // Relación polimórfica para el dueño
    public function propietario()
    {
        return $this->morphTo();
    }

    // Relación con la propiedad
    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class);
    }

}
