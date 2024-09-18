<?php

namespace App\Filament\Resources\Manager;

use App\Filament\Resources\Manager\UserResource\Pages;
use App\Filament\Resources\Manager\UserResource\RelationManagers;
use App\Models\User;
use Auth;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return 'Data User';
    }
    public static function getPluralLabel(): string
    {
        return 'Data User';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('username')
                    ->required()
                    ->maxLength(length: 25),
                Select::make('role_id')
                    ->label('Role')
                    ->relationship('roles', 'name'),
                TextInput::make('email')
                    ->email()
                    ->required(),
                TextInput::make('password')
                    ->password()
                    ->dehydrated(fn ($state) =>filled($state))
                    ->required(fn (Page $livewire) => $livewire instanceof CreateRecord)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('roles.name')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function canViewAny(): bool
    {
        return Auth::user()->can('manage data user');
    }

    public static function canCreate(): bool
    {
        return Auth::user()->can('manage data user');
    }

    public static function canEdit($record): bool
    {
        return Auth::user()->can('manage data user');
    }

    public static function canDelete($record): bool
    {
        return Auth::user()->can('manage data user');
    }

    public static function canDeleteAny(): bool
    {
        return Auth::user()->can('manage data user');
    }

    public static function canForceDelete($record): bool
    {
        return Auth::user()->can('manage data user');
    }

    public static function canForceDeleteAny(): bool
    {
        return Auth::user()->can('manage data user');
    }

    public static function canRestore($record): bool
    {
        return Auth::user()->can('manage data user');
    }

    public static function canRestoreAny(): bool
    {
        return Auth::user()->can('manage data user');
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Management';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
