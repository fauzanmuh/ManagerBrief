<?php

namespace App\Filament\Resources\Developer\TaskReportResource\Pages;

use App\Filament\Resources\Developer\TaskReportResource;
use Auth;
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
                ->color('warning')
                ->icon('heroicon-m-arrow-down-tray')
                ->url(fn() => route('task-reports.download', [
                    'month' => request()->input('month', Carbon::now()->format('m')),
                    'year' => request()->input('year', Carbon::now()->format('Y'))
                ]))
                ->openUrlInNewTab(),
            Actions\CreateAction::make()
                ->label('Create Task Report')
                ->icon('heroicon-m-plus'),
        ];
    }

    protected function getTableQuery(): ?Builder
{
    $query = parent::getTableQuery();

    if (Auth::user()->hasRole('manager')) {
        // Manajer dapat melihat semua data
        return $query; 
    }

    // Developer hanya dapat melihat data mereka sendiri
    return $query->where('user_id', auth()->id());
}
}
