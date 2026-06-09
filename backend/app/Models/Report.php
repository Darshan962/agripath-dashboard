<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
	protected $fillable = [
        'name',
        'workspace_id',
        'report_id',
        'embed_url',
        'markdown_analysis',
    ];
}
