<?php

namespace App\Filament\Resources\Tutores\Pages;

use App\Filament\Resources\Tutores\TutorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTutores extends ListRecords
{
    protected static string $resource = TutorResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
