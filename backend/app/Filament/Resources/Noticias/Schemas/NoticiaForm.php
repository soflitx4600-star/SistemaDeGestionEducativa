<?php

namespace App\Filament\Resources\Noticias\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class NoticiaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titulo')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($set, ?string $state) => $set('slug', Str::slug($state ?? ''))),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Select::make('categoria_id')
                    ->label('Categoría')
                    ->relationship('categoria', 'nombre')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        TextInput::make('nombre')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->required(),
                TextInput::make('descripcion')
                    ->required()
                    ->maxLength(500)
                    ->columnSpanFull(),
                RichEditor::make('contenido')
                    ->columnSpanFull(),
                SpatieMediaLibraryFileUpload::make('imagen')
                    ->collection('imagen')
                    ->image()
                    ->imageEditor()
                    ->columnSpanFull(),
                Toggle::make('activa')
                    ->label('Publicada')
                    ->default(true),
            ]);
    }
}
