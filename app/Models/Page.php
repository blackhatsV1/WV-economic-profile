<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'title', 'description'];

    public function kpis()
    {
        return $this->hasMany(Kpi::class)->orderBy('order');
    }

    public function charts()
    {
        return $this->hasMany(Chart::class)->orderBy('order');
    }

    public function mapMarkers()
    {
        return $this->hasMany(MapMarker::class);
    }

    public function dataSources()
    {
        return $this->hasMany(DataSource::class)->orderBy('order');
    }

    public function tableData()
    {
        return $this->hasMany(TableData::class);
    }
}
