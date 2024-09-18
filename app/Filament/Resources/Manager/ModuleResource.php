<?php

namespace App\Filament\Resources\Manager;

use App\Filament\Resources\Manager\ModuleResource\Pages;
use App\Filament\Resources\Manager\ModuleResource\RelationManagers;
use App\Models\Module;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ModuleResource extends Resource
{
    protected static ?string $model = Module::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static ?int $navigationSort = 7;
    
    public static function getNavigationLabel(): string
    {
        return 'Module';
    }
    public static function getPluralLabel(): string
    {
        return 'Module';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('module_code')
                    ->required()
                    ->label('Module Code')
                    ->unique()
                    ->maxLength(150),
                TextInput::make('module_name')
                    ->required()
                    ->label('Module Name')
                    ->maxLength(255),
                Select::make('project_id')
                    ->label('Project')
                    ->relationship('project', 'project_name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('module_code')
                    ->label('Module Code')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('module_name')
                    ->label('Module Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('project.project_name')
                    ->label('Project')
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
            'index' => Pages\ListModules::route('/'),
            'create' => Pages\CreateModule::route('/create'),
            'edit' => Pages\EditModule::route('/{record}/edit'),
        ];
    }
}
