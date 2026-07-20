<?php

namespace App\Filament\Resources\Roleplays\Pages;

use App\Filament\Resources\Roleplays\RoleplayResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRoleplay extends ViewRecord
{
    protected static string $resource = RoleplayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
