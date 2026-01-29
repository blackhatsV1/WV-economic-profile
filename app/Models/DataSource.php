<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSource extends Model
{
    use HasFactory;

    protected $fillable = ['page_id', 'title', 'url', 'description', 'order', 'year'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
