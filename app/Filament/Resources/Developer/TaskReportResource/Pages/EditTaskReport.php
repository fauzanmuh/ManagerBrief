<?php

namespace App\Filament\Resources\Developer\TaskReportResource\Pages;

use App\Filament\Resources\Developer\TaskReportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTaskReport extends EditRecord
{
    protected static string $resource = TaskReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
