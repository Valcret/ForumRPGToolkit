<?php

namespace App\Filament\Resources\Roleplays\Pages;

use App\Filament\Resources\Roleplays\RoleplayResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRoleplays extends ListRecords
{
    protected static string $resource = RoleplayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
