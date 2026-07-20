<?php

namespace App\Filament\Resources\Characters;

use App\Filament\Resources\Characters\Pages;
use App\Models\Character;
use App\Models\Forum;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class CharacterResource extends Resource
{
    protected static ?string $model = Character::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user';
    protected static string|\UnitEnum|null $navigationGroup = 'Trieur à RP';
    protected static ?string $navigationLabel = 'Personnages';
    protected static ?string $modelLabel = 'Personnage';
    protected static ?string $pluralModelLabel = 'Personnages';
    protected static ?int $navigationSort = 1;

    public static function form(Schema $form): Schema
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nom du personnage')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('alt')
                    ->label('Lien Alt')
                    ->url()
                    ->maxLength(255)
                    ->nullable(),

                Forms\Components\TextInput::make('avatar')
                    ->label('Avatar (URL)')
                    ->maxLength(255)
                    ->nullable(),

                Forms\Components\Select::make('forum_id')
                    ->label('Forum')
                    ->options(Forum::all()->pluck('name', 'id'))
                    ->searchable()
                    ->nullable(),

                Forms\Components\Select::make('user_id')
                    ->label('Joueur')
                    ->options(User::all()->pluck('name', 'id'))
                    ->searchable()
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('avatar')
                    ->label('Avatar')
                    ->circular()
                    ->defaultImageUrl(fn () => asset('images/default-avatar.png')),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Joueur')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('forum.name')
                    ->label('Forum')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('forum_id')
                    ->label('Forum')
                    ->relationship('forum', 'name'),

                Tables\Filters\SelectFilter::make('user_id')
                    ->label('Joueur')
                    ->relationship('user', 'name'),
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
            'index' => Pages\ListCharacters::route('/'),
            'create' => Pages\CreateCharacter::route('/create'),
            'edit' => Pages\EditCharacter::route('/{record}/edit'),
        ];
    }
}
