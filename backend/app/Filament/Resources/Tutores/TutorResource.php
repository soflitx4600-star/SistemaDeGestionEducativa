<?php

namespace App\Filament\Resources\Tutores;

use App\Filament\Resources\Tutores\Pages\CreateTutor;
use App\Filament\Resources\Tutores\Pages\EditTutor;
use App\Filament\Resources\Tutores\Pages\ListTutores;
use App\Filament\Resources\Tutores\Pages\ViewTutor;
use App\Filament\Resources\Tutores\Schemas\TutorForm;
use App\Filament\Resources\Tutores\Schemas\TutorInfolist;
use App\Filament\Resources\Tutores\Tables\TutoresTable;
use App\Models\Tutor;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TutorResource extends Resource
{
    protected static ?string $model = Tutor::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    protected static ?string $navigationLabel = 'Tutores';

    protected static string|\UnitEnum|null $navigationGroup = 'Personal';

    protected static ?string $recordTitleAttribute = 'nombre_completo';

    public static function form(Schema $schema): Schema
    {
        return TutorForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TutorInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TutoresTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListTutores::route('/'),
            'create' => CreateTutor::route('/create'),
            'view'   => ViewTutor::route('/{record}'),
            'edit'   => EditTutor::route('/{record}/edit'),
        ];
    }
}
