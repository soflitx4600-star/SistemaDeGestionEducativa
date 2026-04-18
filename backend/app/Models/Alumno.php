<?php

namespace App\Models;

use App\Enums\EstadoAlumno;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Enums\Fit;

class Alumno extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'cuil',
        'fecha_nacimiento',
        'genero',
        'domicilio',
        'telefono',
        'email',
        'estado',
        'tiene_cud',
    ];

    protected function casts(): array
    {
        return [
            'fecha_nacimiento' => 'date',
            'estado'           => EstadoAlumno::class,
            'tiene_cud'        => 'boolean',
        ];
    }

    public function fichaLegajo(): HasOne
    {
        return $this->hasOne(FichaLegajo::class);
    }

    public function tutores(): BelongsToMany
    {
        return $this->belongsToMany(Tutor::class, 'alumno_tutor')
            ->withPivot('es_responsable_principal')
            ->withTimestamps();
    }

    public function historialAcademico(): HasMany
    {
        return $this->hasMany(HistorialAcademico::class);
    }

    public function getNombreCompletoAttribute(): string
    {
        return "{$this->apellido}, {$this->nombre}";
    }

    // ¡ESTA ES LA RELACIÓN QUE FALTABA!
    public function cursos(): BelongsToMany
    {
        return $this->belongsToMany(Curso::class);
    }
}