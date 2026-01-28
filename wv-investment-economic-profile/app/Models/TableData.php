<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableData extends Model
{
    use HasFactory;

    protected $fillable = ['page_id', 'identifier', 'title', 'headers', 'rows', 'footer_note', 'year'];

    protected $casts = [
        'headers' => 'array',
        'rows' => 'array',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
