<?php

namespace App\Filament\Resources\Consultas;

use App\Filament\Resources\Consultas\Pages\ListConsultas;
use App\Filament\Resources\Consultas\Pages\ViewConsulta;
use App\Filament\Resources\Consultas\Schemas\ConsultaForm;
use App\Filament\Resources\Consultas\Tables\ConsultasTable;
use App\Models\Consulta;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ConsultaResource extends Resource
{
    protected static ?string $model = Consulta::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEnvelope;

    protected static string|\UnitEnum|null $navigationGroup = 'Noticias y consultas';

    protected static ?string $recordTitleAttribute = 'asunto';

    public static function form(Schema $schema): Schema
    {
        return ConsultaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ConsultasTable::configure($table);
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
            'index' => ListConsultas::route('/'),
            'view'  => ViewConsulta::route('/{record}'),
        ];
    }
}
