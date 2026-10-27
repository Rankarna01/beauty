<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Services\OperatingHoursService;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::active()
            ->with(['operatingHours' => function ($query) {
                $query->orderBy('day_of_week');
            }])
            ->orderByDesc('is_main_branch')
            ->orderBy('sort_order')
            ->get();

        return view('pages.locations', compact('locations'));
    }
}
