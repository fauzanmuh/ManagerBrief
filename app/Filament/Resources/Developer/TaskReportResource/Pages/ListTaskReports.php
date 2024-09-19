<?php

namespace App\Filament\Resources\Developer\TaskReportResource\Pages;

use App\Filament\Resources\Developer\TaskReportResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListTaskReports extends ListRecords
{
    protected static string $resource = TaskReportResource::class;

    /**
     * Override the query to only show task reports for the logged-in developer.
     */
    protected function getTableQuery(): ?Builder
    {
        return parent::getTableQuery()->where('user_id', auth()->id());
    }
}
