<?php

namespace App\Filament\Resources\Developer;

use App\Filament\Resources\Developer\TaskReportResource\Pages;
use App\Filament\Resources\Developer\TaskReportResource\RelationManagers;
use App\Models\TaskReport;
use Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Http\Request;

class TaskReportResource extends Resource
{
    protected static ?string $model = TaskReport::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    public static function getNavigationLabel(): string
    {
        return 'Task Report';
    }
    public static function getPluralLabel(): string
    {
        return 'Task Report';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('module_id')
                    ->label('Module')
                    ->relationship('module', 'module_name')
                    ->required(),
                Select::make('task_id')
                    ->label('Task')
                    ->relationship('task', 'task_name')
                    ->required(),
                Select::make('user_id')
                    ->label('Developer')
                    ->relationship('user', 'name')
                    ->options(function () {
                        return \App\Models\User::pluck('name', 'id');
                    })
                    ->default(function () {
                        return auth()->user()->id;
                    })
                    ->disabled(),
                DatePicker::make('date')
                    ->label('Date')
                    ->required(),
                TimePicker::make('start_time')
                    ->label('Start Time')
                    ->required(),
                TimePicker::make('end_time')
                    ->label('End Time'),
                ToggleButtons::make('task_status')
                    ->label('Task Status')
                    ->inline()
                    ->options([
                        'progress' => 'On Progress',
                        'done' => 'Done',
                        'not_started' => 'Not Started',
                    ])
                    ->colors([
                        'progress' => 'warning',
                        'done' => 'success',
                        'not_started' => 'danger',
                    ])
                    ->icons([
                        'progress' => 'heroicon-o-clock',
                        'done' => 'heroicon-o-check-circle',
                        'not_started' => 'heroicon-o-x-circle',
                    ])
                    ->required(),
                Toggle::make('is_overtime')
                    ->label('Is Overtime')
                    ->default(false)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('module.module_name')
                    ->label('Module')
                    ->alignCenter()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('module.module_code')
                    ->label('Module Code')
                    ->alignCenter()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('task.task_name')
                    ->label('Task')
                    ->searchable()
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\TextColumn::make('task.task_code')
                    ->label('Task Code')
                    ->searchable()
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Developer')
                    ->alignCenter()
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->alignCenter()
                    ->date(),
                Tables\Columns\TextColumn::make('start_time')
                    ->label('Start Time')
                    ->alignCenter()
                    ->time(),
                Tables\Columns\TextColumn::make('end_time')
                    ->label('End Time')
                    ->alignCenter()
                    ->time(),
                SelectColumn::make('task_status')
                    ->label('Task Status')
                    ->alignCenter()
                    ->options([
                        'progress' => 'On Progress',
                        'done' => 'Done',
                        'not_started' => 'Not Started'
                    ])
                    ->disabled(fn ($record) => Auth::user()->hasRole('manager'))
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_overtime')
                    ->label('Is Overtime')
                    ->sortable()
                    ->alignCenter()
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function downloadPdf(Request $request)
    {
        $month = $request->input('month', Carbon::now()->format('m'));
        $year = $request->input('year', Carbon::now()->format('Y'));

        // Cek peran pengguna
        if (Auth::user()->hasRole('manager')) {
            // Manajer dapat melihat semua laporan
            $taskReports = TaskReport::with(['module', 'task', 'user'])
                ->whereMonth('date', $month)
                ->whereYear('date', $year)
                ->where('task_status', 'done') // Filter hanya task yang selesai
                ->get();
        } else {
            // Developer hanya dapat melihat laporan mereka sendiri
            $taskReports = TaskReport::with(['module', 'task', 'user'])
                ->whereMonth('date', $month)
                ->whereYear('date', $year)
                ->where('user_id', auth()->id())
                ->where('task_status', 'done') // Filter hanya task yang selesai
                ->get();
        }

        $monthName = Carbon::createFromFormat('m', $month)->format('F');
        $developerName = Auth::user()->name;
        $overtimeLimit = Carbon::parse('17:00:00');

        $totalOvertime = 0;
        foreach ($taskReports as $report) {
            $startTime = Carbon::parse($report->start_time);
            $endTime = Carbon::parse($report->end_time);

            if ($endTime->lessThan($startTime)) {
                $endTime->addDay();
            }

            if ($report->is_overtime && $report->task_status == 'done') {
                if ($endTime->greaterThan($overtimeLimit)) {
                    if ($startTime->lessThan($overtimeLimit)) {
                        $overtimeMinutes = $endTime->diffInMinutes($overtimeLimit);
                    } else {
                        $overtimeMinutes = $endTime->diffInMinutes($startTime);
                    }

                    $totalOvertime += $overtimeMinutes / 60;
                }
            }
        }

        // Generate PDF dengan data
        $pdf = Pdf::loadView('pdf.task_report', [
            'taskReports' => $taskReports,
            'totalOvertime' => round($totalOvertime, 2),
            'monthName' => $monthName,
            'year' => $year,
            'developerName' => Auth::user()->hasRole('manager') ? 'All Developers' : $developerName,
        ]);

        // Nama file PDF
        $fileName = 'Report-' . ($developerName) . '-' . $monthName . '-' . $year . '.pdf';

        // Stream PDF di browser
        return $pdf->stream($fileName);
    }


    public static function canViewAny(): bool
    {
        if (Auth::user()->hasRole('manager')) {
            return true;
        }

        return Auth::user()->hasRole('developer');
    }


    public static function canCreate(): bool
    {
        return Auth::user()->can('manage reports');
    }

    public static function canEdit($record): bool
    {
        return $record->user_id === Auth::user()->id;
    }

    public static function canDelete($record): bool
    {
        return Auth::user()->can('manage reports');
    }

    public static function canDeleteAny(): bool
    {
        return Auth::user()->can('manage reports');
    }

    public static function canForceDelete($record): bool
    {
        return Auth::user()->can('manage reports');
    }

    public static function canForceDeleteAny(): bool
    {
        return Auth::user()->can('manage reports');
    }

    public static function canRestore($record): bool
    {
        return Auth::user()->can('manage reports');
    }

    public static function canRestoreAny(): bool
    {
        return Auth::user()->can('manage reports');
    }

    public static function getNavigationBadge(): ?string
    {
        $userId = auth()->id();

        $count = static::getModel()::where('user_id', $userId)->count();

        return $count > 0 ? (string) $count : null;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTaskReports::route('/'),
            'create' => Pages\CreateTaskReport::route('/create'),
            'edit' => Pages\EditTaskReport::route('/{record}/edit'),
        ];
    }
}
