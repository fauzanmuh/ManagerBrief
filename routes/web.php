<?php

use App\Filament\Resources\Developer\TaskReportResource;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/user/developer/task-reports/download', [TaskReportResource::class, 'downloadPdf'])->name('task-reports.download');
