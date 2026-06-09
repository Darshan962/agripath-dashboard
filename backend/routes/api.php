<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

// Route to fetch the list of reports as JSON
Route::get('/reports', [ReportController::class, 'index']);