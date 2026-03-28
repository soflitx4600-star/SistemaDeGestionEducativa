<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PlanDeEstudio extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'resolucion_numero',
        'ciclo_lectivo_vigencia',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function materias(): HasMany
    {
        return $this->hasMany(Materia::class);
    }

    public function cursos(): HasMany
    {
        return $this->hasMany(Curso::class);
    }
}
