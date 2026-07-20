<?php

namespace App\Filament\Resources\CurrentSheets\Pages;

use App\Filament\Resources\CurrentSheets\CurrentSheetResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCurrentSheet extends EditRecord
{
    protected static string $resource = CurrentSheetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
