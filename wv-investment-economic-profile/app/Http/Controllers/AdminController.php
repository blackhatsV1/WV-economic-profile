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

    public function editPage(Page $page)
    {
        $page->load(['kpis', 'charts', 'mapMarkers', 'dataSources', 'tableData']);
        return view('admin.edit-page', compact('page'));
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

    // Add more methods for other CRUD operations as needed...
}
