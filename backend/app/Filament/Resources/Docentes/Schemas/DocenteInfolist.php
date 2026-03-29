<?php

namespace App\Filament\Resources\Docentes\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class DocenteInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('apellido'),
                TextEntry::make('nombre'),
                TextEntry::make('dni'),
                TextEntry::make('cuil')->placeholder('-'),
                TextEntry::make('telefono')->placeholder('-'),
                TextEntry::make('email')->placeholder('-'),
                TextEntry::make('especialidad')->placeholder('-'),
                TextEntry::make('user.name')->label('Usuario')->placeholder('-'),
                TextEntry::make('created_at')->dateTime()->toggleable(isToggledHiddenByDefault: true),
            ]);
    }
}
