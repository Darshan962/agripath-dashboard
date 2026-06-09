<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Controller to return a JSON response with a list of reports
class ReportController extends Controller
{
    public function index()
    {
        return response() ->json([ 
            'reports' => [
                [
                    'name' =>'Sales Dashboard',
                    'report_id' => '1',
                    'embed_url' => 'https://app.powerbi.com/'
                    
                ]
            ]
        ]);  
    }  

}
