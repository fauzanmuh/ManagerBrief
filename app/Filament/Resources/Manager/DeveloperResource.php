<?php

namespace App\Filament\Resources\Manager;

use App\Filament\Resources\Manager\DeveloperResource\Pages;
use App\Filament\Resources\Manager\DeveloperResource\RelationManagers;
use App\Models\Developer;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DeveloperResource extends Resource
{
    protected static ?string $model = Developer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?int $navigationSort = 3;

    public static function getNavigationLabel(): string
    {
        return 'Developer';
    }
    public static function getPluralLabel(): string
    {
        return 'Developer';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('developer_name')
                    ->label('Developer Name')
                    ->required(),
                TextInput::make('developer_job_title')
                    ->label('Developer Job Title')
                    ->required(),
                TextInput::make('username')
                    ->label('Username')
                    ->required(),
                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('developer_name')
                    ->label('Developer Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('developer_job_title')
                    ->label('Developer Job Title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('username')
                    ->label('Username')
                    ->searchable(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDevelopers::route('/'),
            'create' => Pages\CreateDeveloper::route('/create'),
            'edit' => Pages\EditDeveloper::route('/{record}/edit'),
        ];
    }
}
