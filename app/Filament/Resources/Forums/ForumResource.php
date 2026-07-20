<?php

namespace App\Filament\Resources\Forums;

use App\Filament\Resources\Forums\Pages;
use App\Filament\Resources\Forums\Schemas\ForumForm;
use App\Filament\Resources\Forums\Schemas\ForumInfolist;
use App\Filament\Resources\Forums\Tables\ForumsTable;
use App\Models\Forum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class ForumResource extends Resource
{
    protected static ?string $model = Forum::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static string|\UnitEnum|null $navigationGroup = 'Trieur à RP';
    protected static ?string $navigationLabel = 'Forums';
    protected static ?string $modelLabel = 'Forum';
    protected static ?string $pluralModelLabel = 'Forums';
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return ForumForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ForumInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ForumsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListForums::route('/'),
            'create' => Pages\CreateForum::route('/create'),
            'view' => Pages\ViewForum::route('/{record}'),
            'edit' => Pages\EditForum::route('/{record}/edit'),
        ];
    }
}
