<?php

namespace App\Filament\Resources\PresentationSheets\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PresentationSheetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                Textarea::make('body')
                    ->required()
                    ->columnSpanFull(),
                Select::make('forum_id')
                    ->relationship('forum', 'name')
                    ->required(),
            ]);
    }
}
