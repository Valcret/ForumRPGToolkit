<?php

namespace App\Filament\Resources\EyesColors\Pages;

use App\Filament\Resources\EyesColors\EyesColorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageEyesColors extends ManageRecords
{
    protected static string $resource = EyesColorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
