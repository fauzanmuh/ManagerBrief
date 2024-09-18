<?php

namespace App\Filament\Resources\Developer;

use App\Filament\Resources\Developer\TaskReportResource\Pages;
use App\Filament\Resources\Developer\TaskReportResource\RelationManagers;
use App\Models\TaskReport;
use Auth;
use Date;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TaskReportResource extends Resource
{
    protected static ?string $model = TaskReport::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    protected static ?int $navigationSort = 8;
    
    public static function getNavigationLabel(): string
    {
        return 'Task Report';
    }
    public static function getPluralLabel(): string
    {
        return 'Task Report';
    } 

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('task_id')
                    ->label('Task')
                    ->relationship('task', 'task_name')
                    ->required(),
                Select::make('developer_id')
                    ->label('Developer')
                    ->relationship('developer', 'developer_name')
                    ->required(),
                DatePicker::make('date')
                    ->label('Date')
                    ->required(),
                TimePicker::make('start_time')
                    ->label('Start Time')
                    ->required(),
                TimePicker::make('end_time')
                    ->label('End Time'),
                ToggleButtons::make('task_status')
                    ->label('Task Status')
                    ->options([
                        'progress' => 'On Progress',
                        'done' => 'Done',
                        'not_started' => 'Not Started',
                    ])
                    ->colors([
                        'progress' => 'warning',
                        'done' => 'success',
                        'not_started' => 'danger',
                    ])
                    ->icons([
                        'progress' => 'heroicon-o-clock',
                        'done' => 'heroicon-o-check-circle',
                        'not_started' => 'heroicon-o-x-circle',
                    ])
                    ->required(),
                Toggle::make('is_overtime')
                    ->label('Is Overtime')
                    ->default(false)
                    ->inline()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('task.task_name')
                    ->label('Task')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('developer.developer_name')
                    ->label('Developer')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->date(),
                Tables\Columns\TextColumn::make('start_time')
                    ->label('Start Time')
                    ->time(),
                Tables\Columns\TextColumn::make('end_time')
                    ->label('End Time')
                    ->time(),
                SelectColumn::make('task_status')
                    ->label('Task Status')
                    ->options([
                        'progress' => 'On Progress',
                        'done' => 'Done',
                        'not_started' => 'Not Started'
                    ])
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_overtime')
                        ->label('Is Overtime')
                        ->sortable()
                        ->boolean(),
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
        return Auth::user()->can('manage reports');
    }

    public static function canCreate(): bool
    {
        return Auth::user()->can('manage reports');
    }

    public static function canEdit($record): bool
    {
        return Auth::user()->can('manage reports');
    }

    public static function canDelete($record): bool
    {
        return Auth::user()->can('manage reports');
    }

    public static function canDeleteAny(): bool
    {
        return Auth::user()->can('manage reports');
    }

    public static function canForceDelete($record): bool
    {
        return Auth::user()->can('manage reports');
    }

    public static function canForceDeleteAny(): bool
    {
        return Auth::user()->can('manage reports');
    }

    public static function canRestore($record): bool
    {
        return Auth::user()->can('manage reports');
    }

    public static function canRestoreAny(): bool
    {
        return Auth::user()->can('manage reports');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTaskReports::route('/'),
            'create' => Pages\CreateTaskReport::route('/create'),
            'edit' => Pages\EditTaskReport::route('/{record}/edit'),
        ];
    }
}
