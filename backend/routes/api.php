<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\API\CropDataUploadController;

// Route to fetch the list of reports as JSON
Route::get('/reports', [ReportController::class, 'index']);

Route::post('/crop-data/upload',[CropDataUploadController::class, 'upload']);