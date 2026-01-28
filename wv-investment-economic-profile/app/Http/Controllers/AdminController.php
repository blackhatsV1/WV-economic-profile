<?php

namespace App\Http\Controllers;

use App\Models\Chart;
use App\Models\DataSource;
use App\Models\IndustryCluster;
use App\Models\Kpi;
use App\Models\MapMarker;
use App\Models\Page;
use App\Models\TableData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showLogin()
    {
        if (Auth::check() && Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->is_admin) {
                $request->session()->regenerate();
                return redirect()->intended('admin-portal-access/dashboard');
            }
            Auth::logout();
            return back()->withErrors([
                'email' => 'The provided credentials are not for an admin account.',
            ]);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        $pages = Page::all();
        $clusters = IndustryCluster::all();
        return view('admin.dashboard', compact('pages', 'clusters'));
    }

    public function editPage(Request $request, Page $page)
    {
        $year = $request->input('year', 2024);

        $page->load([
            'kpis' => fn($q) => $q->where('year', $year),
            'charts' => fn($q) => $q->where('year', $year),
            'mapMarkers' => fn($q) => $q->where('year', $year),
            'dataSources' => fn($q) => $q->where('year', $year),
            'tableData' => fn($q) => $q->where('year', $year)
        ]);

        return view('admin.edit-page', compact('page', 'year'));
    }

    public function updateKpi(Request $request, Kpi $kpi)
    {
        $data = $request->validate([
            'label' => 'required|string',
            'value' => 'required|string',
            'trend_value' => 'nullable|string',
            'trend_direction' => 'nullable|string',
            'icon' => 'nullable|string',
        ]);

        $kpi->update($data);
        return back()->with('success', 'KPI updated successfully.');
    }

    public function storeKpi(Request $request, Page $page)
    {
        $data = $request->validate([
            'label' => 'required|string',
            'value' => 'required|string',
            'trend_value' => 'nullable|string',
            'trend_direction' => 'nullable|string',
            'icon' => 'nullable|string',
            'year' => 'required|integer',
        ]);

        $page->kpis()->create($data);
        return back()->with('success', 'KPI added successfully.');
    }

    public function destroyKpi(Kpi $kpi)
    {
        $kpi->delete();
        return back()->with('success', 'KPI removed successfully.');
    }

    public function storeDataSource(Request $request, Page $page)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'url' => 'nullable|url',
            'description' => 'nullable|string',
            'year' => 'required|integer',
        ]);

        $page->dataSources()->create($data);
        return back()->with('success', 'Data Source added successfully.');
    }

    public function updateDataSource(Request $request, DataSource $source)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'url' => 'nullable|url',
            'description' => 'nullable|string',
        ]);

        $source->update($data);
        return back()->with('success', 'Data Source updated successfully.');
    }

    public function destroyDataSource(DataSource $source)
    {
        $source->delete();
        return back()->with('success', 'Data Source removed successfully.');
    }

    public function storeMapMarker(Request $request, Page $page)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'color' => 'nullable|string',
            'type' => 'nullable|string',
            'data' => 'nullable|string',
            'year' => 'required|integer',
        ]);

        $page->mapMarkers()->create($data);
        return back()->with('success', 'Map Marker added successfully.');
    }

    public function destroyMapMarker(MapMarker $marker)
    {
        $marker->delete();
        return back()->with('success', 'Map Marker removed successfully.');
    }

    public function storeIndustryCluster(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:industry_clusters,name',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'color' => 'nullable|string',
            'year' => 'required|integer',
        ]);

        $data['slug'] = \Illuminate\Support\Str::slug($data['name']);

        IndustryCluster::create($data);
        return back()->with('success', 'Industry Cluster added successfully.');
    }

    public function destroyIndustryCluster(IndustryCluster $cluster)
    {
        $cluster->delete();
        return back()->with('success', 'Industry Cluster removed successfully.');
    }
    public function batchUpdateKpis(Request $request)
    {
        $data = $request->validate([
            'kpis' => 'array',
            'kpis.*.id' => 'required|exists:kpis,id',
            'kpis.*.label' => 'required|string',
            'kpis.*.value' => 'required|string',
            'kpis.*.trend_value' => 'nullable|string',
            'kpis.*.trend_direction' => 'nullable|string',
            'kpis.*.year' => 'required|integer',
        ]);

        foreach ($data['kpis'] ?? [] as $kpiData) {
            Kpi::where('id', $kpiData['id'])->update($kpiData);
        }

        return back()->with('success', 'KPIs updated successfully.');
    }

    public function batchUpdateDataSources(Request $request)
    {
        $data = $request->validate([
            'sources' => 'array',
            'sources.*.id' => 'required|exists:data_sources,id',
            'sources.*.title' => 'required|string',
            'sources.*.url' => 'nullable|url',
            'sources.*.description' => 'nullable|string',
            'sources.*.year' => 'required|integer',
        ]);

        foreach ($data['sources'] ?? [] as $sourceData) {
            DataSource::where('id', $sourceData['id'])->update($sourceData);
        }

        return back()->with('success', 'Data Sources updated successfully.');
    }

    public function batchUpdateMapMarkers(Request $request)
    {
        $data = $request->validate([
            'markers' => 'array',
            'markers.*.id' => 'required|exists:map_markers,id',
            'markers.*.name' => 'required|string',
            'markers.*.lat' => 'required|numeric',
            'markers.*.lng' => 'required|numeric',
            'markers.*.color' => 'nullable|string',
            'markers.*.type' => 'nullable|string',
            'markers.*.year' => 'required|integer',
        ]);

        foreach ($data['markers'] ?? [] as $markerData) {
            MapMarker::where('id', $markerData['id'])->update($markerData);
        }

        return back()->with('success', 'Map Markers updated successfully.');
    }
}
