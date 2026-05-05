<?php

namespace App\Filament\Resources\Docentes\Pages;

use App\Filament\Resources\Docentes\DocenteResource;
use App\Filament\Resources\Docentes\Schemas\DocenteForm;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\HasWizard;

class CreateDocente extends CreateRecord
{
    use HasWizard;

    protected static string $resource = DocenteResource::class;

    public function getSteps(): array
    {
        return DocenteForm::getSteps();
    }
}
