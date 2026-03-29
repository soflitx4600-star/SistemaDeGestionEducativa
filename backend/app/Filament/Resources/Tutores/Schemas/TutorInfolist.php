<?php

namespace App\Filament\Resources\Tutores\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TutorInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('apellido'),
                TextEntry::make('nombre'),
                TextEntry::make('dni'),
                TextEntry::make('cuil')->placeholder('-'),
                TextEntry::make('parentesco'),
                TextEntry::make('telefono')->placeholder('-'),
                TextEntry::make('email')->placeholder('-'),
                TextEntry::make('domicilio')->placeholder('-'),
            ]);
    }
}
