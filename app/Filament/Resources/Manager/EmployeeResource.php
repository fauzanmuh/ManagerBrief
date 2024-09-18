<?php

namespace App\Filament\Resources\Manager;

use App\Filament\Resources\Manager\EmployeeResource\Pages;
use App\Filament\Resources\Manager\EmployeeResource\RelationManagers;
use App\Models\Employee;
use Auth;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?int $navigationSort = 2;

    public static function getNavigationLabel(): string
    {
        return 'Employee';
    }
    public static function getPluralLabel(): string
    {
        return 'Employee';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->label('Name')
                    ->columnSpanFull()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->label('Email'),
                TextInput::make(name: 'position')
                    ->label('Position')
                    ->maxLength(150),
                Textarea::make(name: 'address')
                    ->label('Address')
                    ->columnSpanFull()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('position')
                    ->label('Position')
                    ->searchable(),
                Tables\Columns\TextColumn::make(name: 'address')
                    ->label('Address')
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
                ]),
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
        return Auth::user()->can('manage employees');
    }

    public static function canCreate(): bool
    {
        return Auth::user()->can('manage employees');
    }

    public static function canEdit($record): bool
    {
        return Auth::user()->can('manage employees');
    }

    public static function canDelete($record): bool
    {
        return Auth::user()->can('manage employees');
    }

    public static function canDeleteAny(): bool
    {
        return Auth::user()->can('manage employees');
    }

    public static function canForceDelete($record): bool
    {
        return Auth::user()->can('manage employees');
    }

    public static function canForceDeleteAny(): bool
    {
        return Auth::user()->can('manage employees');
    }

    public static function canRestore($record): bool
    {
        return Auth::user()->can('manage employees');
    }

    public static function canRestoreAny(): bool
    {
        return Auth::user()->can('manage employees');
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Management';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
