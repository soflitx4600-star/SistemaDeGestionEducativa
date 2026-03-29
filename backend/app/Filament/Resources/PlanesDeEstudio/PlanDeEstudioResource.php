<?php

namespace App\Filament\Resources\PlanesDeEstudio;

use App\Filament\Resources\PlanesDeEstudio\Pages\CreatePlanDeEstudio;
use App\Filament\Resources\PlanesDeEstudio\Pages\EditPlanDeEstudio;
use App\Filament\Resources\PlanesDeEstudio\Pages\ListPlanesDeEstudio;
use App\Filament\Resources\PlanesDeEstudio\Pages\ViewPlanDeEstudio;
use App\Filament\Resources\PlanesDeEstudio\Schemas\PlanDeEstudioForm;
use App\Filament\Resources\PlanesDeEstudio\Schemas\PlanDeEstudioInfolist;
use App\Filament\Resources\PlanesDeEstudio\Tables\PlanesDeEstudioTable;
use App\Models\PlanDeEstudio;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PlanDeEstudioResource extends Resource
{
    protected static ?string $model = PlanDeEstudio::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $navigationLabel = 'Planes de Estudio';

    protected static string|\UnitEnum|null $navigationGroup = 'Académico';

    protected static ?string $recordTitleAttribute = 'nombre';

    public static function form(Schema $schema): Schema
    {
        return PlanDeEstudioForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PlanDeEstudioInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PlanesDeEstudioTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListPlanesDeEstudio::route('/'),
            'create' => CreatePlanDeEstudio::route('/create'),
            'view'   => ViewPlanDeEstudio::route('/{record}'),
            'edit'   => EditPlanDeEstudio::route('/{record}/edit'),
        ];
    }
}
