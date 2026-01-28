<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kpi extends Model
{
    use HasFactory;

    protected $fillable = ['page_id', 'label', 'value', 'trend_value', 'trend_direction', 'icon', 'order', 'year'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
