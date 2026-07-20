<?php

namespace App\Filament\Resources\Beards\Pages;

use App\Filament\Resources\Beards\BeardResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBeards extends ListRecords
{
    protected static string $resource = BeardResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
