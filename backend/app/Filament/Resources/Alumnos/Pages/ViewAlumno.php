<?php

namespace App\Filament\Resources\Alumnos\Pages;

use App\Enums\EstadoDocumento;
use App\Enums\TipoDocumento;
use App\Filament\Resources\Alumnos\AlumnoResource;
use App\Filament\Resources\Alumnos\Schemas\AlumnoInfolist;
use App\Models\DocumentoLegajo;
use App\Models\FichaLegajo;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class ViewAlumno extends ViewRecord
{
    protected static string $resource = AlumnoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            Action::make('pdf')
                ->label('Descargar PDF')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->url(fn () => route('alumnos.pdf', $this->record))
                ->openUrlInNewTab(),
            DeleteAction::make(),
            Action::make('agregar_documento')
                ->label('Agregar documento')
                ->icon('heroicon-o-plus')
                ->color('info')
                ->form([
                    Select::make('tipo_documento')
                        ->label('Tipo de documento')
                        ->options(
                            collect(TipoDocumento::cases())
                                ->mapWithKeys(fn ($case) => [$case->value => $case->label()])
                        )
                        ->required()
                        ->live(),
                    Select::make('estado')
                        ->label('Estado')
                        ->options(
                            collect(EstadoDocumento::cases())
                                ->mapWithKeys(fn ($case) => [$case->value => $case->label()])
                        )
                        ->default(EstadoDocumento::Adjunto->value)
                        ->required(),
                    FileUpload::make('archivo_path')
                        ->label('Archivo (PDF o imagen)')
                        ->disk('public')
                        ->directory('legajos/documentos')
                        ->visibility('public')
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'application/pdf'])
                        ->maxSize(5120)
                        ->columnSpanFull(),
                    DatePicker::make('fecha_vencimiento')
                        ->label('Fecha de vencimiento')
                        ->visible(fn (Get $get) => TipoDocumento::tryFrom($get('tipo_documento'))?->tieneVencimiento()),
                ])
                ->action(function (array $data): void {
                    $ficha = $this->record->fichaLegajo ?? FichaLegajo::create([
                        'alumno_id'      => $this->record->id,
                        'numero_legajo'  => 'LEG-' . str_pad($this->record->id, 5, '0', STR_PAD_LEFT),
                        'fecha_apertura' => now(),
                    ]);

                    DocumentoLegajo::updateOrCreate(
                        ['ficha_legajo_id' => $ficha->id, 'tipo_documento' => $data['tipo_documento']],
                        [
                            'archivo_path'      => $data['archivo_path'] ?? null,
                            'estado'            => $data['archivo_path'] ? $data['estado'] : EstadoDocumento::Pendiente->value,
                            'fecha_vencimiento' => $data['fecha_vencimiento'] ?? null,
                        ]
                    );

                    $this->record->refresh();

                    Notification::make()->title('Documento guardado correctamente')->success()->send();
                }),
        ];
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make()
                ->tabs([
                    Tab::make('Datos del Alumno')
                        ->icon('heroicon-o-user')
                        ->schema(
                            AlumnoInfolist::configure(
                                Schema::make($this)->components([])
                            )->getComponents()
                        ),

                    Tab::make('Legajo')
                        ->icon('heroicon-o-folder-open')
                        ->schema([
                            Section::make('Documentos')
                                ->schema([
                                    RepeatableEntry::make('fichaLegajo.documentos')
                                        ->label('')
                                        ->schema([
                                            TextEntry::make('tipo_documento')
                                                ->label('Documento')
                                                ->formatStateUsing(fn ($state) => $state instanceof TipoDocumento ? $state->label() : $state),
                                            TextEntry::make('estado')
                                                ->label('Estado')
                                                ->badge()
                                                ->color(fn ($state) => match ($state?->value ?? $state) {
                                                    'validado'  => 'success',
                                                    'adjunto'   => 'warning',
                                                    'rechazado' => 'danger',
                                                    default     => 'gray',
                                                }),
                                            TextEntry::make('archivo_path')
                                                ->label('Archivo')
                                                ->formatStateUsing(fn ($state) => $state ? '✔ Ver archivo' : '✘ Sin archivo')
                                                ->color(fn ($state) => $state ? 'success' : 'danger')
                                                ->url(fn ($state) => $state ? asset('storage/' . $state) : null)
                                                ->openUrlInNewTab(),
                                            TextEntry::make('fecha_vencimiento')
                                                ->label('Vencimiento')
                                                ->date('d/m/Y')
                                                ->placeholder('—'),
                                        ])
                                        ->columns(4)
                                        ->columnSpanFull(),
                                ]),
                        ]),
                ])
                ->columnSpanFull(),
        ]);
    }
}
