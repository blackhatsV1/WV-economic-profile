<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapMarker extends Model
{
    use HasFactory;

    protected $fillable = ['page_id', 'name', 'lat', 'lng', 'color', 'data', 'type', 'year'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
