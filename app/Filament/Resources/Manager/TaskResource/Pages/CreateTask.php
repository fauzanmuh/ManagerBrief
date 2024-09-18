<?php

namespace App\Filament\Resources\Manager\TaskResource\Pages;

use App\Filament\Resources\Manager\TaskResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTask extends CreateRecord
{
    protected static string $resource = TaskResource::class;
}
