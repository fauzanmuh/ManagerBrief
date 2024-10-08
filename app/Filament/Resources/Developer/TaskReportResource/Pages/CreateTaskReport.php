<?php

namespace App\Filament\Resources\Developer\TaskReportResource\Pages;

use App\Filament\Resources\Developer\TaskReportResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTaskReport extends CreateRecord
{
    protected static string $resource = TaskReportResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }
}
