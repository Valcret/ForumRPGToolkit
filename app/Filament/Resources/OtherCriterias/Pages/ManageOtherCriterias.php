<?php

namespace App\Filament\Resources\OtherCriterias\Pages;

use App\Filament\Resources\OtherCriterias\OtherCriteriaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageOtherCriterias extends ManageRecords
{
    protected static string $resource = OtherCriteriaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
