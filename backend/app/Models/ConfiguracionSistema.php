<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class ConfiguracionSistema extends Model
{
    protected $table = 'configuraciones_sistema';

    protected $fillable = [
        'clave',
        'valor',
        'descripcion',
    ];

    /**
     * Obtiene el valor de una clave de configuración.
     * Usa cache para evitar queries repetitivas.
     */
    public static function obtener(string $clave, mixed $default = null): mixed
    {
        return Cache::remember("config.sistema.{$clave}", 3600, function () use ($clave, $default) {
            $registro = static::where('clave', $clave)->first();
            return $registro ? $registro->valor : $default;
        });
    }

    /**
     * Actualiza un valor e invalida su cache.
     */
    public static function establecer(string $clave, string $valor): void
    {
        static::updateOrCreate(['clave' => $clave], ['valor' => $valor]);
        Cache::forget("config.sistema.{$clave}");
    }
}
