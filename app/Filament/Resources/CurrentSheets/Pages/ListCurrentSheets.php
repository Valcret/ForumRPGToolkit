<?php

namespace App\Filament\Resources\CurrentSheets\Pages;

use App\Filament\Resources\CurrentSheets\CurrentSheetResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCurrentSheets extends ListRecords
{
    protected static string $resource = CurrentSheetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
