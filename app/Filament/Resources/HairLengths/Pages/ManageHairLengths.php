<?php

namespace App\Filament\Resources\HairLengths\Pages;

use App\Filament\Resources\HairLengths\HairLengthResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageHairLengths extends ManageRecords
{
    protected static string $resource = HairLengthResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
