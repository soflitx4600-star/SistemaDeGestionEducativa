<?php

namespace App\Filament\Resources\Consultas\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ConsultaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre_completo')
                    ->required(),
                TextInput::make('correo_electronico')
                    ->email()
                    ->required(),
                TextInput::make('telefono')
                    ->tel()
                    ->required(),
                TextInput::make('asunto')
                    ->required(),
                Textarea::make('mensaje')
                    ->required()
                    ->columnSpanFull(),
                Select::make('estado')
                    ->options([
                        'pendiente' => 'Pendiente',
                        'resuelto' => 'Resuelto',
                    ])
                    ->default('pendiente')
                    ->required(),
            ]);
    }
}
