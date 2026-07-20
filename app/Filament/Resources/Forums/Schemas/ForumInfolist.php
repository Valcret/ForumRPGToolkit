<?php

namespace App\Filament\Resources\Forums\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ForumInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('alt')
                    ->placeholder('-'),
                IconEntry::make('nsfw')
                    ->boolean(),
            ]);
    }
}
