<?php

namespace App\Filament\Resources\ImageSizes\Pages;

use App\Filament\Resources\ImageSizes\ImageSizeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageImageSizes extends ManageRecords
{
    protected static string $resource = ImageSizeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
