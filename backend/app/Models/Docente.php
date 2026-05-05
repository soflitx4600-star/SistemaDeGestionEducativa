<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Docente extends Model
{
    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'cuil',
        'telefono',
        'email',
        'titulo',
        'localidad',
    ];

    public function materias(): BelongsToMany
    {
        return $this->belongsToMany(Materia::class, 'docente_materia')
            ->withPivot(['ciclo_lectivo', 'es_titular'])
            ->withTimestamps();
    }

    public function getNombreCompletoAttribute(): string
    {
        return "{$this->apellido}, {$this->nombre}";
    }
}
