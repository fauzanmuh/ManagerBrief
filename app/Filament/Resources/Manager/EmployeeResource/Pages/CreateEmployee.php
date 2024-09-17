<?php

namespace App\Filament\Resources\Manager\EmployeeResource\Pages;

use App\Filament\Resources\Manager\EmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEmployee extends CreateRecord
{
    protected static string $resource = EmployeeResource::class;
}
