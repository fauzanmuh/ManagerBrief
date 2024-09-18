<?php

namespace App\Filament\Resources\Manager;

use App\Filament\Resources\Manager\TaskTypeResource\Pages;
use App\Filament\Resources\Manager\TaskTypeResource\RelationManagers;
use App\Models\TaskType;
use Auth;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TaskTypeResource extends Resource
{
    protected static ?string $model = TaskType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 6;
    
    public static function getNavigationLabel(): string
    {
        return 'Task Type';
    }
    public static function getPluralLabel(): string
    {
        return 'Task Type';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->columnSpanFull()
                    ->label('Name')
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
        return Auth::user()->can('manage task types');
    }

    public static function canCreate(): bool
    {
        return Auth::user()->can('manage task types');
    }

    public static function canEdit($record): bool
    {
        return Auth::user()->can('manage task types');
    }

    public static function canDelete($record): bool
    {
        return Auth::user()->can('manage task types');
    }

    public static function canDeleteAny(): bool
    {
        return Auth::user()->can('manage task types');
    }

    public static function canForceDelete($record): bool
    {
        return Auth::user()->can('manage task types');
    }

    public static function canForceDeleteAny(): bool
    {
        return Auth::user()->can('manage task types');
    }

    public static function canRestore($record): bool
    {
        return Auth::user()->can('manage task types');
    }

    public static function canRestoreAny(): bool
    {
        return Auth::user()->can('manage task types');
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Task Management';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTaskTypes::route('/'),
            'create' => Pages\CreateTaskType::route('/create'),
            'edit' => Pages\EditTaskType::route('/{record}/edit'),
        ];
    }
}
