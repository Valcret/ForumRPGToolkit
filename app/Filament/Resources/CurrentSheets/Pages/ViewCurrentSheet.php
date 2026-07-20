<?php

namespace App\Filament\Resources\CurrentSheets\Pages;

use App\Filament\Resources\CurrentSheets\CurrentSheetResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCurrentSheet extends ViewRecord
{
    protected static string $resource = CurrentSheetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
