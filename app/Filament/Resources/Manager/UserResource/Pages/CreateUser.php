<?php

namespace App\Filament\Resources\Manager\UserResource\Pages;

use App\Filament\Resources\Manager\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
