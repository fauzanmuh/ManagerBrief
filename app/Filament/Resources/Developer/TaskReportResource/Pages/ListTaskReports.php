<?php

namespace App\Filament\Resources\Developer\TaskReportResource\Pages;

use App\Filament\Resources\Developer\TaskReportResource;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListTaskReports extends ListRecords
{
    protected static string $resource = TaskReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('download') // Use the correct namespace
                ->label('Download PDF')
                ->url(fn() => route('task-reports.download', [
                    'month' => request()->input('month', Carbon::now()->format('m')),
                    'year' => request()->input('year', Carbon::now()->format('Y'))
                ]))
                ->openUrlInNewTab(),
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableQuery(): ?Builder
    {
        return parent::getTableQuery()->where('user_id', auth()->id());
    }
}
