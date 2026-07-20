<?php

namespace App\Filament\Resources\Histories\Pages;

use App\Filament\Resources\Histories\HistoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageHistories extends ManageRecords
{
    protected static string $resource = HistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
