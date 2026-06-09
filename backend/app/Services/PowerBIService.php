<?php

namespace App\Services;

use App\Models\Report;

class PowerBIService
{
    public function getReports()
    {
        return Report::all();
    }
}