<?php
namespace App\Filament\Resources\ForumTags\Pages;

use App\Filament\Resources\ForumTags\ForumTagResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\CreateAction;

class ListForumTags extends ListRecords
{
    protected static string $resource = ForumTagResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
