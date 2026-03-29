<?php

namespace App\Filament\Resources\HistorialAcademicos;

use App\Filament\Resources\HistorialAcademicos\Pages\CreateHistorialAcademico;
use App\Filament\Resources\HistorialAcademicos\Pages\EditHistorialAcademico;
use App\Filament\Resources\HistorialAcademicos\Pages\ListHistorialAcademicos;
use App\Filament\Resources\HistorialAcademicos\Schemas\HistorialAcademicoForm;
use App\Filament\Resources\HistorialAcademicos\Tables\HistorialAcademicosTable;
use App\Models\HistorialAcademico;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HistorialAcademicoResource extends Resource
{
    protected static ?string $model = HistorialAcademico::class;
    protected static string|\UnitEnum|null $navigationGroup = 'Gestión Académica';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return HistorialAcademicoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HistorialAcademicosTable::configure($table);
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
            'index' => ListHistorialAcademicos::route('/'),
            'create' => CreateHistorialAcademico::route('/create'),
            'edit' => EditHistorialAcademico::route('/{record}/edit'),
        ];
    }
}
