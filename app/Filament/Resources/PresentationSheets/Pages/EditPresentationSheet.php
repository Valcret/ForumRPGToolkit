<?php

namespace App\Filament\Resources\PresentationSheets\Pages;

use App\Filament\Resources\PresentationSheets\PresentationSheetResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPresentationSheet extends EditRecord
{
    protected static string $resource = PresentationSheetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
