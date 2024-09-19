<?php

namespace App\Filament\Resources\Developer\TaskReportResource\Pages;

use App\Filament\Resources\Developer\TaskReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListTaskReports extends ListRecords
{
    protected static string $resource = TaskReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableQuery(): ?Builder
    {
        return parent::getTableQuery()->where('user_id', auth()->id());
    }
}
