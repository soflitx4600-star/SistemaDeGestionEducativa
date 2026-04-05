<?php

namespace App\Filament\Resources\Cursos\RelationManagers;

use App\Filament\Imports\AlumnoImporter;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class AlumnosRelationManager extends RelationManager
{
    protected static string $relationship = 'alumnos';

    protected static ?string $recordTitleAttribute = 'nombre';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('apellido')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nombre')
            ->columns([
                Tables\Columns\TextColumn::make('nombre')->searchable(),
                Tables\Columns\TextColumn::make('apellido')->searchable(),
                Tables\Columns\TextColumn::make('dni')->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // USAMOS LA RUTA COMPLETA PARA QUE NO HAYA ERROR esto es lo q da problema 
                // \Filament\Tables\Actions\ImportAction::make()
                //     ->importer(AlumnoImporter::class)
                //     ->label('Importar Excel')
                //     ->color('success'),
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
            ]);
    }
}