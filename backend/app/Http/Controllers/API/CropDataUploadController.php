<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\CropDataImport;
use Maatwebsite\Excel\Facades\Excel;

class CropDataUploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(
            new CropDataImport,
            $request->file('file')
        );

        return response()->json([
            'message' => 'Import successful'
        ]);
    }
}
