<?php

namespace App\Filament\Resources\Histories\Pages;

use App\Filament\Resources\Histories;
use App\Filament\Resources\Histories\HistoryResource;
use Filament\Resources\Pages\EditRecord;

class EditHistory extends EditRecord
{
    protected static string $resource = HistoryResource::class;
}
