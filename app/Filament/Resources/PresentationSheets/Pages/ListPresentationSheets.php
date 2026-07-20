<?php

namespace App\Filament\Resources\PresentationSheets\Pages;

use App\Filament\Resources\PresentationSheets\PresentationSheetResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPresentationSheets extends ListRecords
{
    protected static string $resource = PresentationSheetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
