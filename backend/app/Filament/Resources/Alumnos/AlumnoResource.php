<?php

namespace App\Filament\Resources\Alumnos;

use App\Filament\Resources\Alumnos\Pages\CreateAlumno;
use App\Filament\Resources\Alumnos\Pages\EditAlumno;
use App\Filament\Resources\Alumnos\Pages\ListAlumnos;
use App\Filament\Resources\Alumnos\Pages\ViewAlumno;
use App\Filament\Resources\Alumnos\Schemas\AlumnoForm;
use App\Filament\Resources\Alumnos\Schemas\AlumnoInfolist;
use App\Filament\Resources\Alumnos\Tables\AlumnosTable;
use App\Models\Alumno;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AlumnoResource extends Resource
{
    protected static ?string $model = Alumno::class;
    protected static string|\UnitEnum|null $navigationGroup = 'Gestión Académica';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;
    protected static ?string $navigationLabel = 'Alumnos';

    protected static ?string $recordTitleAttribute = 'nombre';

    public static function form(Schema $schema): Schema
    {
        return AlumnoForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AlumnoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AlumnosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListAlumnos::route('/'),
            'create' => CreateAlumno::route('/create'),
            'view'   => ViewAlumno::route('/{record}'),
            'edit'   => EditAlumno::route('/{record}/edit'),
        ];
    }
}
