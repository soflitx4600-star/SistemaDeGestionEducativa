<?php

namespace App\Filament\Resources\Tutores\Pages;

use App\Filament\Resources\Tutores\TutorResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTutor extends ViewRecord
{
    protected static string $resource = TutorResource::class;

    protected function getHeaderActions(): array
    {
        return [EditAction::make()];
    }
}
