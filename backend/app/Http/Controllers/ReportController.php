<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

// Controller to return a JSON response with a list of reports
class ReportController extends Controller
{
    public function index()
    {
        return response()->json([
            'reports' => Report::all(),
        ]);
    }
}  


