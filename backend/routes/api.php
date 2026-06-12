<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\API\CropDataUploadController;
use App\Http\Controllers\API\PowerBIReportController;
use App\Http\Controllers\API\CropDataController;



// Route to fetch the list of reports as JSON
Route::get('/reports', [ReportController::class, 'index']);

Route::post('/crop-data/upload',[CropDataUploadController::class, 'upload']);

Route::get('/powerbi/reports', [PowerBIReportController::class, 'index']);

Route::get('/crop-data/chart', [CropDataController::class, 'chart']);