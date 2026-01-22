<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function regionalOverview()
    {
        return view('dashboard.regional-overview');
    }

    public function industryContribution()
    {
        return view('dashboard.industry-contribution');
    }

    public function businessProfile()
    {
        return view('dashboard.business-profile');
    }

    public function workforceEducation()
    {
        return view('dashboard.workforce-education');
    }

    public function infrastructure()
    {
        return view('dashboard.infrastructure');
    }

    public function priorityIndustries()
    {
        return view('dashboard.priority-industries');
    }
}
