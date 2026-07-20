<?php

namespace App\Filament\Resources\Beards\Pages;

use App\Filament\Resources\Beards\BeardResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageBeards extends ManageRecords
{
    protected static string $resource = BeardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
