<?php

namespace App\Filament\Resources\Cursos\RelationManagers;

use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use App\Models\Alumno;

// ¡ACÁ ESTÁ LA MAGIA! USAMOS LA RUTA CORRECTA DE TU SISTEMA
use Filament\Actions\Action;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\AttachAction;
class AlumnosRelationManager extends RelationManager
{
    protected static string $relationship = 'alumnos';

    protected static ?string $recordTitleAttribute = 'nombre';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nombre')
            ->columns([
                Tables\Columns\TextColumn::make('nombre')->searchable(),
                Tables\Columns\TextColumn::make('apellido')->searchable(),
                Tables\Columns\TextColumn::make('dni')->searchable(),
            ])
            ->headerActions([
                 AttachAction::make()
                    ->label('Agregar alumno')
                    ->preloadRecordSelect()
                    ->recordSelectSearchColumns(['dni', 'nombre', 'apellido', 'email']),
                // Nuestro botón de importación nativo, apuntando a la clase Action correcta
                Action::make('importar_csv')
                    ->label('Importar CSV')
                    ->color('success')
                    ->icon('heroicon-o-document-arrow-up')
                    ->form([
                        Forms\Components\FileUpload::make('archivo')
                            ->label('Cargar archivo .csv')
                            ->acceptedFileTypes(['text/csv', 'application/csv', 'text/plain', '.csv'])
                            ->disk('local')
                            ->directory('importaciones')
                            ->required(),
                    ])
                    ->action(function (array $data, RelationManager $livewire) {
                        $rutaArchivo = storage_path('app/' . $data['archivo']);
                        $curso = $livewire->getOwnerRecord();
                        $cantidad = 0;

                        if (($handle = fopen($rutaArchivo, "r")) !== FALSE) {
                            $titulos = fgetcsv($handle, 1000, ",");
                            
                            if ($titulos) {
                                $titulos = array_map('strtolower', array_map('trim', $titulos));
                                $idxDni = array_search('dni', $titulos);
                                $idxNombre = array_search('nombre', $titulos);
                                $idxApellido = array_search('apellido', $titulos);

                                if ($idxDni !== false && $idxNombre !== false && $idxApellido !== false) {
                                    while (($fila = fgetcsv($handle, 1000, ",")) !== FALSE) {
                                        $dni = trim($fila[$idxDni] ?? '');
                                        $nombre = trim($fila[$idxNombre] ?? '');
                                        $apellido = trim($fila[$idxApellido] ?? '');

                                        if ($dni && $nombre && $apellido) {
                                            $alumno = Alumno::firstOrCreate(
                                                ['dni' => $dni],
                                                ['nombre' => $nombre, 'apellido' => $apellido]
                                            );

                                            $curso->alumnos()->syncWithoutDetaching([$alumno->id]);
                                            $cantidad++;
                                        }
                                    }
                                }
                            }
                            fclose($handle);
                        }

                        if (file_exists($rutaArchivo)) {
                            unlink($rutaArchivo);
                        }

                        Notification::make()
                            ->title('Importación Exitosa')
                            ->body("Se cargaron y vincularon {$cantidad} alumnos al curso.")
                            ->success()
                            ->send();
                    }),
            ])
            ->actions([
                DetachAction::make(),
            ])
            ->bulkActions([
                DetachBulkAction::make(),
            ]);
    }
}