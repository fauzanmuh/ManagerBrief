<?php

namespace App\Filament\Resources\Manager\AdminResource\Pages;

use App\Filament\Resources\Manager\AdminResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAdmin extends CreateRecord
{
    protected static string $resource = AdminResource::class;
}
