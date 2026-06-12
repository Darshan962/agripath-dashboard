<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PowerBIReportController extends Controller
{
    protected $token;
    protected $client;
    
    public function __construct()

    {
        if (app()->runningInConsole()) {
            return;
        }

        // TODO:

        // Create Azure OAuth provider

        // Get Power BI access token

        // Create Power BI SDK client

    }

    public function index(Request $request)
    {
        return response()->json([

            'message' => 'Power BI report metadata endpoint stubbed.',
            'workspace' => $request->query('workspace'),
            'next_step' => 'Connect Azure credentials and Power BI SDK client.'
        ]);
    }
}
