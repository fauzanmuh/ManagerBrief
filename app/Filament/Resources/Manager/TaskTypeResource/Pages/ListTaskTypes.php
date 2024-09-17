<?php

namespace App\Filament\Resources\Manager\TaskTypeResource\Pages;

use App\Filament\Resources\Manager\TaskTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTaskTypes extends ListRecords
{
    protected static string $resource = TaskTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
