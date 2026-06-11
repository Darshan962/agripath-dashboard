<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CropData extends Model
{
    protected $fillable = [
        'farm_id',
        'crop',
        'year',
        'grossmargin_t',
        'grossmargin',
        'grossincome',
        'grain_yield',
        'wue',
        'yieldcosts',
    ];
}
