<?php

namespace App\Filament\Resources\PresentationSheets;


use App\Filament\Resources\PresentationSheets\Pages\CreatePresentationSheet;
use App\Filament\Resources\PresentationSheets\Pages\EditPresentationSheet;
use App\Filament\Resources\PresentationSheets\Pages\ListPresentationSheets;
use App\Models\Forum;
use App\Models\PresentationSheet;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;

class PresentationSheetResource extends Resource
{
    protected static ?string $model = PresentationSheet::class;

    protected static string|null|\BackedEnum $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Fiches disponibles';

    protected static ?int $navigationSort = 1;

    protected static string|\UnitEnum|null  $navigationGroup = 'Sheet\'Craft';
    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),

                Select::make('forum_id')
                    ->label('Forum')
                    ->relationship('forum', 'name')
                    ->required(),

                RichEditor::make('body')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('forum.name')
                    ->label('Forum')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPresentationSheets::route('/'),
            'create' => CreatePresentationSheet::route('/create'),
            'edit' => EditPresentationSheet::route('/{record}/edit'),
        ];
    }
}
