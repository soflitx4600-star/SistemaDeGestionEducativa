<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Docente extends Model implements HasMedia
{
    use InteractsWithMedia;
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

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('docentes')->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }
}
