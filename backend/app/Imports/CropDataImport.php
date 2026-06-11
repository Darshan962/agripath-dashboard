<?php

namespace App\Imports;

use App\Models\CropData;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CropDataImport implements ToModel, WithHeadingRow

{
        public function model(array $row)
    {
        return new CropData([
            'farm_id'         => $row['farm_id'],
            'crop'            => $row['crop'],
            'year'            => $row['year'],
            'grossmargin_t'   => $row['grossmargin_t'],
            'grossmargin'     => $row['grossmargin'],
            'grossincome'     => $row['grossincome'],
            'grain_yield'     => $row['grain_yield'],
            'wue'             => $row['wue'],
            'yieldcosts'      => $row['yieldcosts'],
        ]);
    }
}
