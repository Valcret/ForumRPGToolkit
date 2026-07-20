<?php

namespace App\Filament\Resources\Roleplays\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class RoleplayInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('url')
                    ->placeholder('-'),
                TextEntry::make('created_by')
                    ->numeric(),
                TextEntry::make('prequel')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('sequel')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('forum.name')
                    ->label('Forum'),
                TextEntry::make('started')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('ended')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('current_sum')
                    ->numeric(),
                TextEntry::make('max_turn')
                    ->numeric(),
                TextEntry::make('current_turn')
                    ->numeric(),
                TextEntry::make('status.name')
                    ->label('Status'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
