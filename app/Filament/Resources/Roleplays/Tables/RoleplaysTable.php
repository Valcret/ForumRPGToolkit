<?php

namespace App\Filament\Resources\Roleplays\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;

class RoleplaysTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('url')
                    ->searchable(),
                TextColumn::make('created_by')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('prequel')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('sequel')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('forum.name')
                    ->searchable(),
                TextColumn::make('started')
                    ->date()
                    ->sortable(),
                TextColumn::make('ended')
                    ->date()
                    ->sortable(),
                TextColumn::make('current_sum')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('max_turn')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('current_turn')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status.name')
                    ->searchable(),
                TextColumn::make('last_post_at')
                    ->label('Dernier message')
                    ->formatStateUsing(fn (?Carbon $state) => $state?->diffForHumans() ?? '—')
                    ->sortable(),
                TextColumn::make('last_post_author')
                    ->label('Auteur du dernier message')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('last_synced_at')
                    ->label('Dernière synchro')
                    ->formatStateUsing(fn (?Carbon $state) => $state?->diffForHumans() ?? 'Jamais')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
