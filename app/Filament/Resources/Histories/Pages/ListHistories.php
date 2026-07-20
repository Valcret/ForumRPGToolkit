<?php

namespace App\Filament\Resources\Histories\Pages;

use App\Filament\Resources\Histories;
use App\Filament\Resources\Histories\HistoryResource;
use Filament\Resources\Pages\ListRecords;

class ListHistories extends ListRecords
{
    protected static string $resource = HistoryResource::class;
}
