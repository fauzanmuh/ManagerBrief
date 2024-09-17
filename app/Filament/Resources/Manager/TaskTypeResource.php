<?php

namespace App\Filament\Resources\Manager;

use App\Filament\Resources\Manager\TaskTypeResource\Pages;
use App\Filament\Resources\Manager\TaskTypeResource\RelationManagers;
use App\Models\TaskType;
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
                    ->label('Name')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTaskTypes::route('/'),
            'create' => Pages\CreateTaskType::route('/create'),
            'edit' => Pages\EditTaskType::route('/{record}/edit'),
        ];
    }
}
