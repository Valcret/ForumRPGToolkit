<?php

namespace App\Filament\Resources\RoleplayStatuses\Pages;

use App\Filament\Resources\RoleplayStatuses\RoleplayStatusResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageRoleplayStatuses extends ManageRecords
{
    protected static string $resource = RoleplayStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
