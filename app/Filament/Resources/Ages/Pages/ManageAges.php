<?php

namespace App\Filament\Resources\Ages\Pages;

use App\Filament\Resources\Ages\AgeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageAges extends ManageRecords
{
    protected static string $resource = AgeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
