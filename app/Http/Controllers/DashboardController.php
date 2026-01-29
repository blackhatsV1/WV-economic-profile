<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\IndustryCluster;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected function getPageData($slug, $year)
    {
        return Page::where('slug', $slug)
            ->with([
                'kpis' => fn($q) => $q->where('year', $year),
                'charts' => fn($q) => $q->where('year', $year),
                'mapMarkers' => fn($q) => $q->where('year', $year),
                'dataSources' => fn($q) => $q->where('year', $year),
                'tableData' => fn($q) => $q->where('year', $year)
            ])
            ->firstOrFail();
    }

    public function regionalOverview(Request $request)
    {
        $year = $request->input('year', 2024);
        $page = $this->getPageData('regional-overview', $year);
        return view('dashboard.regional-overview', compact('page', 'year'));
    }

    public function industryContribution(Request $request)
    {
        $year = $request->input('year', 2024);
        $page = $this->getPageData('industry-contribution', $year);
        return view('dashboard.industry-contribution', compact('page', 'year'));
    }

    public function businessProfile(Request $request)
    {
        $year = $request->input('year', 2024);
        $page = $this->getPageData('business-profile', $year);
        return view('dashboard.business-profile', compact('page', 'year'));
    }

    public function workforceEducation(Request $request)
    {
        $year = $request->input('year', 2024);
        $page = $this->getPageData('workforce-education', $year);
        return view('dashboard.workforce-education', compact('page', 'year'));
    }

    public function infrastructure(Request $request)
    {
        $year = $request->input('year', 2024);
        $page = $this->getPageData('infrastructure', $year);
        return view('dashboard.infrastructure', compact('page', 'year'));
    }

    public function priorityIndustries(Request $request)
    {
        $year = $request->input('year', 2024);
        $page = Page::where('slug', 'priority-industries')->firstOrFail();
        $clusters = IndustryCluster::where('year', $year)->orderBy('order')->get();
        return view('dashboard.priority-industries', compact('page', 'clusters', 'year'));
    }
}
