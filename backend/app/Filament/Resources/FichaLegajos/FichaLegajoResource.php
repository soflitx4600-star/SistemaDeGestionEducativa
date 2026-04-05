<?php

namespace App\Filament\Resources\FichaLegajos;

use App\Filament\Resources\FichaLegajos\Pages\CreateFichaLegajo;
use App\Filament\Resources\FichaLegajos\Pages\EditFichaLegajo;
use App\Filament\Resources\FichaLegajos\Pages\ListFichaLegajos;
use App\Filament\Resources\FichaLegajos\Pages\ViewFichaLegajo;
use App\Filament\Resources\FichaLegajos\Schemas\FichaLegajoForm;
use App\Filament\Resources\FichaLegajos\Schemas\FichaLegajoInfolist;
use App\Filament\Resources\FichaLegajos\Tables\FichaLegajosTable;
use App\Models\FichaLegajo;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FichaLegajoResource extends Resource
{
    protected static ?string $model = FichaLegajo::class;
    protected static string|\UnitEnum|null $navigationGroup = 'Gestión Académica';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFolder;
    protected static ?string $navigationLabel = 'Legajos';
    protected static ?string $recordTitleAttribute = 'numero_legajo';

    public static function form(Schema $schema): Schema
    {
        return FichaLegajoForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return FichaLegajoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FichaLegajosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListFichaLegajos::route('/'),
            'create' => CreateFichaLegajo::route('/create'),
            'view'   => ViewFichaLegajo::route('/{record}'),
            'edit'   => EditFichaLegajo::route('/{record}/edit'),
        ];
    }
}
