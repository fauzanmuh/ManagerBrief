<?php

use App\Filament\Resources\Developer\TaskReportResource;
use Doctrine\DBAL\Logging\Middleware;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/task-reports/download', [TaskReportResource::class, 'downloadPdf'])->name('task-reports.download')->middleware('auth');
