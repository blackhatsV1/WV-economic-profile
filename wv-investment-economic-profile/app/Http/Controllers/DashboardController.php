<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\IndustryCluster;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected function getPageData($slug)
    {
        return Page::where('slug', $slug)
            ->with(['kpis', 'charts', 'mapMarkers', 'dataSources', 'tableData'])
            ->firstOrFail();
    }

    public function regionalOverview()
    {
        $page = $this->getPageData('regional-overview');
        return view('dashboard.regional-overview', compact('page'));
    }

    public function industryContribution()
    {
        $page = $this->getPageData('industry-contribution');
        return view('dashboard.industry-contribution', compact('page'));
    }

    public function businessProfile()
    {
        $page = $this->getPageData('business-profile');
        return view('dashboard.business-profile', compact('page'));
    }

    public function workforceEducation()
    {
        $page = $this->getPageData('workforce-education');
        return view('dashboard.workforce-education', compact('page'));
    }

    public function infrastructure()
    {
        $page = $this->getPageData('infrastructure');
        return view('dashboard.infrastructure', compact('page'));
    }

    public function priorityIndustries()
    {
        $page = Page::where('slug', 'priority-industries')->firstOrFail();
        $clusters = IndustryCluster::orderBy('order')->get();
        return view('dashboard.priority-industries', compact('page', 'clusters'));
    }
}
