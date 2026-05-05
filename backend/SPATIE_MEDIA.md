# Spatie Media Library — Guía para el agente IA

Este proyecto usa **Filament Spatie Media Library Plugin** (`filament/spatie-laravel-media-library-plugin`) como capa de manejo de archivos en reemplazo del `FileUpload` nativo de Filament. Los archivos **no** se guardan como rutas en columnas de la tabla del modelo, sino en la tabla `media` gestionada por Spatie.

---

## Regla general

> **Nunca uses `FileUpload`, `ImageColumn` ni `ImageEntry` nativos de Filament en este proyecto.**
> Usa siempre los equivalentes de Spatie:
> - Formularios: `SpatieMediaLibraryFileUpload` (`Filament\Forms\Components\SpatieMediaLibraryFileUpload`)
> - Tablas:      `SpatieMediaLibraryImageColumn` (`Filament\Tables\Columns\SpatieMediaLibraryImageColumn`)
> - Infolists:   `SpatieMediaLibraryImageEntry` (`Filament\Infolists\Components\SpatieMediaLibraryImageEntry`)

---

## Modelos preparados

Todo modelo que gestione archivos debe:

1. Implementar la interfaz `Spatie\MediaLibrary\HasMedia`
2. Usar el trait `Spatie\MediaLibrary\InteractsWithMedia`
3. Declarar sus colecciones en `registerMediaCollections()`
4. Declarar conversiones en `registerMediaConversions()` (conversión `preview` estándar)

### Modelos actuales con Spatie

| Modelo | Colecciones | Descripción |
|---|---|---|
| `Alumno` | `alumnos` (singleFile), `cud` (singleFile) | Foto de perfil y archivo CUD |
| `Docente` | `docentes` (singleFile) | Foto de perfil |
| `DocumentoLegajo` | `documentos_legajo` (singleFile) | Documentos del legajo (PDF o imagen) |

### Ejemplo de modelo preparado

```php
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MiModelo extends Model implements HasMedia
{
    use InteractsWithMedia;

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('mi_coleccion')->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }
}
```

> Usar `->singleFile()` garantiza que cada registro tenga como máximo un archivo en esa colección. Al subir uno nuevo, el anterior se elimina automáticamente.

---

## Componentes de Filament

### Formulario — `SpatieMediaLibraryFileUpload`

```php
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

SpatieMediaLibraryFileUpload::make('foto')
    ->collection('alumnos')   // nombre de la colección registrada en el modelo
    ->avatar()                // muestra preview circular (para fotos de perfil)
    ->image()
    ->imageEditor()
    ->circleCropper()
    ->maxSize(2048)           // en KB
    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
    ->columnSpanFull(),
```

Para archivos de documentos (PDF + imágenes):

```php
SpatieMediaLibraryFileUpload::make('archivo_path')
    ->collection('documentos_legajo')
    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'application/pdf'])
    ->maxSize(5120)           // 5 MB en KB
    ->columnSpanFull(),
```

**No agregar** `->disk()`, `->directory()` ni `->visibility()`. Spatie gestiona la ubicación según la configuración del disco en `config/filesystems.php` y la variable `FILESYSTEM_DISK`.

### Tabla — `SpatieMediaLibraryImageColumn`

```php
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

SpatieMediaLibraryImageColumn::make('foto')
    ->collection('alumnos')
    ->circular()
    ->defaultImageUrl(fn ($record) => 'https://ui-avatars.com/api/?name='.urlencode($record->nombre).'&background=184158&color=fff')
    ->size(40),
```

### Infolist — `SpatieMediaLibraryImageEntry`

```php
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;

SpatieMediaLibraryImageEntry::make('foto')
    ->collection('alumnos')
    ->circular(false)
    ->defaultImageUrl(fn ($record) => 'https://ui-avatars.com/api/?name='.urlencode($record->nombre_completo).'&background=184158&color=fff&size=200')
    ->width(150)
    ->height(150),
```

---

## Convenciones de colecciones del proyecto

| Nombre de colección | Modelo | Tipo de archivo |
|---|---|---|
| `alumnos` | `Alumno` | Foto de perfil (imagen) |
| `cud` | `Alumno` | Certificado Único de Discapacidad (PDF o imagen) |
| `docentes` | `Docente` | Foto de perfil (imagen) |
| `documentos_legajo` | `DocumentoLegajo` | Documentos del legajo (PDF o imagen) |

---

## Cómo agregar Spatie a un nuevo modelo

1. Agregar `implements HasMedia` a la declaración de la clase.
2. Agregar `use InteractsWithMedia;` como trait.
3. Importar `Spatie\MediaLibrary\HasMedia`, `Spatie\MediaLibrary\InteractsWithMedia`, `Spatie\MediaLibrary\MediaCollections\Models\Media` y `Spatie\Image\Enums\Fit`.
4. Definir `registerMediaCollections()` con las colecciones necesarias.
5. Definir `registerMediaConversions()` con la conversión `preview`.
6. En el formulario Filament, usar `SpatieMediaLibraryFileUpload` con `->collection('nombre')`.
7. En la tabla, usar `SpatieMediaLibraryImageColumn` con `->collection('nombre')`.
8. En el infolist, usar `SpatieMediaLibraryImageEntry` con `->collection('nombre')`.
9. **No** agregar una columna en la migración para guardar la ruta del archivo; Spatie usa la tabla `media`.

---

## Archivos clave del proyecto

```
app/Models/Alumno.php               → HasMedia, colecciones: alumnos, cud
app/Models/Docente.php              → HasMedia, colección: docentes
app/Models/DocumentoLegajo.php      → HasMedia, colección: documentos_legajo

app/Filament/Resources/Alumnos/Schemas/AlumnoForm.php
app/Filament/Resources/Alumnos/Tables/AlumnosTable.php
app/Filament/Resources/Alumnos/Schemas/AlumnoInfolist.php
app/Filament/Resources/Alumnos/Pages/ViewAlumno.php

app/Filament/Resources/Docentes/Schemas/DocenteForm.php
app/Filament/Resources/Docentes/Tables/DocentesTable.php

app/Filament/Resources/FichaLegajos/Schemas/FichaLegajoForm.php
```
