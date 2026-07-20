<?php

namespace App\Filament\Resources\ImageSizes\Pages;

use App\Filament\Resources\ImageSizes;
use App\Filament\Resources\ImageSizes\ImageSizeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateImageSize extends CreateRecord
{
    protected static string $resource = ImageSizeResource::class;
}
