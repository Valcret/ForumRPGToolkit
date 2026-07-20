<?php

namespace App\Filament\Resources\Roleplays;

use App\Filament\Resources\Roleplays\Pages;
use App\Models\Roleplay;
use App\Models\Character;
use App\Models\Forum;
use App\Models\RoleplayStatus;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
class RoleplayResource extends Resource
{
    protected static ?string $model = Roleplay::class;
    protected static string|null|\BackedEnum $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Sujets';
    protected static ?string $modelLabel = 'Sujet';
    protected static string|\UnitEnum|null $navigationGroup = 'Trieur à RP';
    protected static ?int $navigationSort = 1;


    public static function form(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Roleplay')
                ->schema([
                    TextInput::make('title')
                        ->label('Titre du roleplay')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('url')
                        ->label('Lien vers le sujet')
                        ->url()
                        ->required()
                        ->maxLength(500),

                    Select::make('forum_id')
                        ->label('Forum')
                        ->options(Forum::pluck('name', 'id'))
                        ->searchable()
                        ->required(),

                    Select::make('roleplay_status_id')
                        ->label('Statut')
                        ->options(RoleplayStatus::pluck('name', 'id'))
                        ->searchable()
                        ->required(),

                    Select::make('characters')
                        ->label('Participants')
                        ->multiple()
                        ->relationship('characters', 'name')
                        ->searchable(),
                ]),

        ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Titre')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('url')
                    ->label('Lien')
                    ->url(fn ($record) => $record->url)
                    ->openUrlInNewTab()
                    ->limit(40),

                Tables\Columns\TextColumn::make('forum.name')
                    ->label('Forum')
                    ->sortable(),

                Tables\Columns\TextColumn::make('roleplayStatus.name')
                    ->label('Statut')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('characters.name')
                    ->label('Participants')
                    ->badge()
                    ->separator(','),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListRoleplays::route('/'),
            'create' => Pages\CreateRoleplay::route('/create'),
            'edit'   => Pages\EditRoleplay::route('/{record}/edit'),
        ];
    }
}
