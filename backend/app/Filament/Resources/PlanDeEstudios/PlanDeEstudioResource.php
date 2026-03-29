<?php

namespace App\Filament\Resources\PlanDeEstudios;

use App\Filament\Resources\PlanDeEstudios\Pages\CreatePlanDeEstudio;
use App\Filament\Resources\PlanDeEstudios\Pages\EditPlanDeEstudio;
use App\Filament\Resources\PlanDeEstudios\Pages\ListPlanDeEstudios;
use App\Filament\Resources\PlanDeEstudios\Pages\ViewPlanDeEstudio;
use App\Filament\Resources\PlanDeEstudios\Schemas\PlanDeEstudioForm;
use App\Filament\Resources\PlanDeEstudios\Schemas\PlanDeEstudioInfolist;
use App\Filament\Resources\PlanDeEstudios\Tables\PlanDeEstudiosTable;
use App\Models\PlanDeEstudio;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PlanDeEstudioResource extends Resource
{
    protected static ?string $model = PlanDeEstudio::class;
    protected static string|\UnitEnum|null $navigationGroup = 'Gestión de Materias';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

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
        return PlanDeEstudiosTable::configure($table);
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
            'index' => ListPlanDeEstudios::route('/'),
            'create' => CreatePlanDeEstudio::route('/create'),
            'view' => ViewPlanDeEstudio::route('/{record}'),
            'edit' => EditPlanDeEstudio::route('/{record}/edit'),
        ];
    }
}
