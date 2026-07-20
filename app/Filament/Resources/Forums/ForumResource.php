<?php

namespace App\Filament\Resources\Forums;

use App\Filament\Resources\Forums\Pages;
use App\Models\Forum;
use App\Models\ForumTag;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class ForumResource extends Resource
{
    protected static ?string $model = Forum::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static string|\UnitEnum|null $navigationGroup = 'Trieur à RP';
    protected static ?string $navigationLabel = 'Forums';
    protected static ?string $modelLabel = 'Forum';
    protected static ?string $pluralModelLabel = 'Forums';
    protected static ?int $navigationSort = 1;

    public static function form(Schema $form): Schema
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nom du forum')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('alt')
                    ->label('Lien Alt')
                    ->url()
                    ->maxLength(255)
                    ->nullable(),

                Forms\Components\Toggle::make('nsfw')
                    ->label('NSFW')
                    ->default(false),

                Forms\Components\Select::make('tags')
                    ->label('Tags')
                    ->multiple()
                    ->relationship('tags', 'name')
                    ->preload()
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('alt')
                    ->label('Lien Alt')
                    ->searchable(),

                Tables\Columns\IconColumn::make('nsfw')
                    ->label('NSFW')
                    ->boolean(),

                Tables\Columns\TextColumn::make('tags.name')
                    ->label('Tags')
                    ->badge(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('nsfw')
                    ->label('NSFW'),

                Tables\Filters\SelectFilter::make('tags')
                    ->label('Tags')
                    ->relationship('tags', 'name')
                    ->multiple(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('name');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListForums::route('/'),
            'create' => Pages\CreateForum::route('/create'),
            'edit' => Pages\EditForum::route('/{record}/edit'),
        ];
    }
}
