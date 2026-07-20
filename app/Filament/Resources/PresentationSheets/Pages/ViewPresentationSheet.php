<?php

namespace App\Filament\Resources\PresentationSheets\Pages;

use App\Filament\Resources\PresentationSheets\PresentationSheetResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPresentationSheet extends ViewRecord
{
    protected static string $resource = PresentationSheetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
