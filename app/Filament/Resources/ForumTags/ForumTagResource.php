<?php

namespace App\Filament\Resources\ForumTags;

use App\Filament\Resources\ForumTags\Pages;
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

class ForumTagResource extends Resource
{
    protected static ?string $model = ForumTag::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-tag';
    protected static string|\UnitEnum|null $navigationGroup = 'Trieur à RP';
    protected static ?string $navigationLabel = 'Tags';
    protected static ?string $modelLabel = 'Tag';
    protected static ?string $pluralModelLabel = 'Tags';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $form): Schema
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nom du tag')
                    ->required()
                    ->maxLength(255),
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

                Tables\Columns\TextColumn::make('forums_count')
                    ->label('Forums associés')
                    ->counts('forums')
                    ->sortable(),
            ])
            ->filters([])
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
            'index' => Pages\ListForumTags::route('/'),
            'create' => Pages\CreateForumTag::route('/create'),
            'edit' => Pages\EditForumTag::route('/{record}/edit'),
        ];
    }
}
