<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CropData;

class CropDataController extends Controller
{
    public function index(Request $request)
    {
        $query = CropData::query();

        if ($request->crop) {
            $query->where('crop', $request->crop);
        }

        if ($request->year) {
            $query->where('year', $request->year);
        }

        if ($request->farm_id) {
            $query->where('farm_id', $request->farm_id);
        }

        return $query->get();
    }

    public function chart(Request $request)
    {
        $allowedMetrics = [        
            'grossmargin_t',
            'grossmargin',
            'grossincome',
            'grain_yield',
            'wue',
            'yieldcosts',
        ];

        $metric = $request->query('metric', 'grossmargin');

        if (!in_array($metric, $allowedMetrics)) {
            return response()->json([
                'message' => 'Invalid metric selected.'
            ], 422);
        }
        $query = CropData::query();

        if ($request->crop) {
            $query->where('crop', $request->crop);
        }
        
        if ($request->year) {
            $query->where('year', $request->year);
        }
        
        $rows = $query

        ->selectRaw("farm_id, AVG($metric) as value")
    
        ->groupBy('farm_id')
    
        ->orderBy('farm_id')
    
        ->get();
    
    return $rows->map(function ($row) use ($request) {
    
        return [
    
            'farm_id' => $row->farm_id,
    
            'value' => round($row->value, 2),
    
            'highlight' => $request->farm_id
    
                ? $row->farm_id == $request->farm_id
    
                : false,
    
        ];
    
    });     
    }

}
