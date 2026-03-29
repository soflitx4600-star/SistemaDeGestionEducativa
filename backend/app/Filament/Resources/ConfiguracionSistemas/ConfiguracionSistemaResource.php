<?php

namespace App\Filament\Resources\ConfiguracionSistemas;

use App\Filament\Resources\ConfiguracionSistemas\Pages\CreateConfiguracionSistema;
use App\Filament\Resources\ConfiguracionSistemas\Pages\EditConfiguracionSistema;
use App\Filament\Resources\ConfiguracionSistemas\Pages\ListConfiguracionSistemas;
use App\Filament\Resources\ConfiguracionSistemas\Schemas\ConfiguracionSistemaForm;
use App\Filament\Resources\ConfiguracionSistemas\Tables\ConfiguracionSistemasTable;
use App\Models\ConfiguracionSistema;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ConfiguracionSistemaResource extends Resource
{
    protected static ?string $model = ConfiguracionSistema::class;
    protected static string|\UnitEnum|null $navigationGroup = 'Configuración del Sistema';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;
    protected static ?string $navigationLabel = 'Configuración';

    public static function form(Schema $schema): Schema
    {
        return ConfiguracionSistemaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ConfiguracionSistemasTable::configure($table);
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
            'index' => ListConfiguracionSistemas::route('/'),
            'create' => CreateConfiguracionSistema::route('/create'),
            'edit' => EditConfiguracionSistema::route('/{record}/edit'),
        ];
    }
}
