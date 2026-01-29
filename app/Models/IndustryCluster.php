<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndustryCluster extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'title', 'kpis', 'chart_data', 'details', 'order', 'year'];

    protected $casts = [
        'kpis' => 'array',
        'chart_data' => 'array',
        'details' => 'array',
    ];
}
