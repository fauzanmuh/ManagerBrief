<?php

namespace App\Filament\Resources\Manager;

use App\Filament\Resources\Manager\ProjectResource\Pages;
use App\Filament\Resources\Manager\ProjectResource\RelationManagers;
use App\Models\Project;
use Auth;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 4;

    public static function getNavigationLabel(): string
    {
        return 'Project';
    }
    public static function getPluralLabel(): string
    {
        return 'Project';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('project_name')
                    ->required()
                    ->label('Project Name'),
                TextInput::make('project_client')
                    ->required()
                    ->label('Client Name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('project_name')
                    ->label('Project Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('project_client')
                    ->label('Client Name')
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
        return Auth::user()->can('manage projects');
    }

    public static function canCreate(): bool
    {
        return Auth::user()->can('manage projects');
    }

    public static function canEdit($record): bool
    {
        return Auth::user()->can('manage projects');
    }

    public static function canDelete($record): bool
    {
        return Auth::user()->can('manage projects');
    }

    public static function canDeleteAny(): bool
    {
        return Auth::user()->can('manage projects');
    }

    public static function canForceDelete($record): bool
    {
        return Auth::user()->can('manage projects');
    }

    public static function canForceDeleteAny(): bool
    {
        return Auth::user()->can('manage projects');
    }

    public static function canRestore($record): bool
    {
        return Auth::user()->can('manage projects');
    }

    public static function canRestoreAny(): bool
    {
        return Auth::user()->can('manage projects');
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Project Management';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
