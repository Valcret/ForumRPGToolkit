<?php

namespace App\Filament\Resources\HairColors\Pages;

use App\Filament\Resources\HairColors\HairColorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageHairColors extends ManageRecords
{
    protected static string $resource = HairColorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
