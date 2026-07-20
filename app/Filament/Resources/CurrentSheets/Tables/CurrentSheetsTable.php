<?php

namespace App\Filament\Resources\CurrentSheets\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class CurrentSheetsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Joueur')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('presentationSheet.title')
                    ->label('Template')
                    ->searchable(),

                TextColumn::make('expiration')
                    ->label('Expiration')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->color(fn ($record) => $record->expiration < now() ? 'danger' : 'success'),
            ]);
    }
}
