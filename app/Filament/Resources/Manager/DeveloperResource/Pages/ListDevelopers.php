<?php

namespace App\Filament\Resources\Manager\DeveloperResource\Pages;

use App\Filament\Resources\Manager\DeveloperResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDevelopers extends ListRecords
{
    protected static string $resource = DeveloperResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
