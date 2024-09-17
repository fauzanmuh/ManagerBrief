<?php

namespace App\Filament\Resources\Developer;

use App\Filament\Resources\Developer\TaskReportResource\Pages;
use App\Filament\Resources\Developer\TaskReportResource\RelationManagers;
use App\Models\TaskReport;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TaskReportResource extends Resource
{
    protected static ?string $model = TaskReport::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';

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
                //
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
            'index' => Pages\ListTaskReports::route('/'),
            'create' => Pages\CreateTaskReport::route('/create'),
            'edit' => Pages\EditTaskReport::route('/{record}/edit'),
        ];
    }
}
