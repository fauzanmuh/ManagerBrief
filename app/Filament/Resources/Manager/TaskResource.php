<?php

namespace App\Filament\Resources\Manager;

use App\Filament\Resources\Manager\TaskResource\Pages;
use App\Filament\Resources\Manager\TaskResource\RelationManagers;
use App\Models\Task;
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

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 5;

    public static function getNavigationLabel(): string
    {
        return 'Task';
    }
    public static function getPluralLabel(): string
    {
        return 'Task';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('task_type_id')
                    ->label('Task Type')
                    ->relationship('taskType', 'name')
                    ->required()
                    ->reactive(),

                Select::make('module_id')
                    ->label('Module')
                    ->relationship('module', 'module_name')
                    ->visible(
                        fn($record, $get) => \App\Models\TaskType::query()
                        ->where('id', $get('task_type_id'))
                        ->whereIn('name', ['Task', 'R & D']) // Tampilkan jika Task Type adalah Task atau R&D
                        ->exists()
                    )
                    ->disabled(
                        fn($record, $get) => \App\Models\TaskType::query()
                        ->where('id', $get('task_type_id'))
                        ->whereIn('name', ['Meeting', 'Content', 'Discussion'])
                        ->exists()
                    ),
                TextInput::make('task_code')
                    ->label('Task Code')
                    ->required(),
                TextInput::make('work_load')
                    ->label('Work Load')
                    ->required()
                    ->numeric()
                    ->minValue(value: 1)
                    ->maxValue(8),
                TextInput::make('task_name')
                    ->label('Task Name')
                    ->columnSpanFull()
                    ->required(),
                Textarea::make('task_description')
                    ->label('Task Description')
                    ->columnSpanFull()
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('module.module_name')
                    ->label('Module')
                    ->searchable()
                    ->default('-')
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\TextColumn::make('module.module_code')
                    ->label('Module Code')
                    ->searchable()
                    ->default('-')
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\TextColumn::make('taskType.name')
                    ->label('Task Type')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('task_code')
                    ->label('Task Code')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('task_name')
                    ->label('Task Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('task_description')
                    ->label('Task Description'),
                Tables\Columns\TextColumn::make('work_load')
                    ->label('Work Load')
                    ->formatStateUsing(function (Task $record) {
                        return $record->work_load . ' hours';
                    })
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
        return Auth::user()->can('manage tasks');
    }

    public static function canCreate(): bool
    {
        return Auth::user()->can('manage tasks');
    }

    public static function canEdit($record): bool
    {
        return Auth::user()->can('manage tasks');
    }

    public static function canDelete($record): bool
    {
        return Auth::user()->can('manage tasks');
    }

    public static function canDeleteAny(): bool
    {
        return Auth::user()->can('manage tasks');
    }

    public static function canForceDelete($record): bool
    {
        return Auth::user()->can('manage tasks');
    }

    public static function canForceDeleteAny(): bool
    {
        return Auth::user()->can('manage tasks');
    }

    public static function canRestore($record): bool
    {
        return Auth::user()->can('manage tasks');
    }

    public static function canRestoreAny(): bool
    {
        return Auth::user()->can('manage tasks');
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Task Management';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }
}
