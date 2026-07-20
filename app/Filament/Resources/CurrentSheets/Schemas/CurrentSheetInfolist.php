<?php

namespace App\Filament\Resources\CurrentSheets\Schemas;

use App\Models\PresentationSheet;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;

class CurrentSheetInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make('user.name')
                ->label('Joueur'),

            TextEntry::make('presentationSheet.title')
                ->label('Template'),

            TextEntry::make('expiration')
                ->label('Expiration')
                ->dateTime('d/m/Y H:i'),

            Group::make()
                ->schema(function ($record) {
                    if (!$record?->presentationSheet) return [];

                    preg_match_all('/\{\{(\w+)\}\}/', $record->presentationSheet->body, $matches);
                    $placeholders = array_unique($matches[1]);

                    return array_map(
                        fn($key) => TextEntry::make("values_{$key}")
                            ->label(ucfirst($key))
                            ->state(fn($record) => $record->values[$key] ?? '—'),
                        $placeholders
                    );
                }),
        ]);
    }
}
