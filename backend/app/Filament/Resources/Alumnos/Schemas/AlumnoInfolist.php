<?php

namespace App\Filament\Resources\Alumnos\Schemas;

use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AlumnoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        SpatieMediaLibraryImageEntry::make('foto')
                            ->label('')
                            ->collection('alumnos')
                            ->circular(false)
                            ->defaultImageUrl(fn ($record) => 'https://ui-avatars.com/api/?name=' . urlencode($record->nombre_completo) . '&background=184158&color=fff&size=200')
                            ->width(150)
                            ->height(150)
                            ->extraImgAttributes(['style' => 'object-fit: cover; border-radius: 4px;'])
                            ->columnSpan(1),

                        Section::make()
                            ->schema([
                                TextEntry::make('nombre_completo')
                                    ->label('Nombre completo'),
                                TextEntry::make('estado')
                                    ->badge()
                                    ->color(fn ($state) => match ($state?->value ?? $state) {
                                        'regular'      => 'success',
                                        'preinscripto' => 'warning',
                                        'egresado'     => 'info',
                                        'suspendido'   => 'danger',
                                        'abandono'     => 'gray',
                                        default        => 'gray',
                                    }),
                                TextEntry::make('tiene_cud')
                                    ->label('CUD')
                                    ->formatStateUsing(fn ($state) => $state ? 'Tiene CUD' : 'Sin CUD')
                                    ->badge()
                                    ->color(fn ($state) => $state ? 'warning' : 'gray'),
                            ])
                            ->columnSpan(3),
                    ])
                    ->columns(4),

                Section::make('Datos Personales')
                    ->schema([
                        TextEntry::make('dni')->label('DNI'),
                        TextEntry::make('cuil')->label('CUIL')->placeholder('—'),
                        TextEntry::make('fecha_nacimiento')->label('Fecha de nacimiento')->date('d/m/Y'),
                        TextEntry::make('genero')->label('Género')->formatStateUsing(fn ($state) => ucfirst($state ?? '—')),
                        TextEntry::make('domicilio')->label('Domicilio')->columnSpanFull(),
                        TextEntry::make('telefono')->label('Teléfono')->placeholder('—'),
                        TextEntry::make('email')->label('Email')->placeholder('—'),
                    ])
                    ->columns(2),
            ]);
    }
}
