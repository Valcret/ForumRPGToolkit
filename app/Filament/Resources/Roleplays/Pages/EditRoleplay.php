<?php

namespace App\Filament\Resources\Roleplays\Pages;

use App\Filament\Resources\Roleplays\RoleplayResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditRoleplay extends EditRecord
{
    protected static string $resource = RoleplayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
