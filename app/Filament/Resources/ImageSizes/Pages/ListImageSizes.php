<?php

namespace App\Filament\Resources\ImageSizes\Pages;

use App\Filament\Resources\ImageSizes;
use App\Filament\Resources\ImageSizes\ImageSizeResource;
use Filament\Resources\Pages\ListRecords;

class ListImageSizes extends ListRecords
{
    protected static string $resource = ImageSizeResource::class;
}
