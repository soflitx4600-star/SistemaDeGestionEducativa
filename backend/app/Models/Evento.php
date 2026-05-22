<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Evento extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'titulo',
        'descripcion',
        'contenido',
        'lugar',
        'fecha_evento',
        'imagen',
        'color',
        'text_color',
        'destacado',
        'activa',
    ];

    protected function casts(): array
    {
        return [
            'fecha_evento' => 'date',
            'destacado' => 'boolean',
            'activa' => 'boolean',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('imagen')
            ->singleFile();
    }
}