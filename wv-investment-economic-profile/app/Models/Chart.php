<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chart extends Model
{
    use HasFactory;

    protected $fillable = ['page_id', 'identifier', 'title', 'type', 'labels', 'datasets', 'options', 'order'];

    protected $casts = [
        'labels' => 'array',
        'datasets' => 'array',
        'options' => 'array',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
