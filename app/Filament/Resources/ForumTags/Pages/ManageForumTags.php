<?php

namespace App\Filament\Resources\ForumTags\Pages;

use App\Filament\Resources\ForumTags\ForumTagResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageForumTags extends ManageRecords
{
    protected static string $resource = ForumTagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
