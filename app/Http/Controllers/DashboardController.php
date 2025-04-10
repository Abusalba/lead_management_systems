<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        // Cache for performance (5 mins)
        $totalLeads = Cache::remember('total_leads', 300, fn() => Lead::count());
        $convertedLeads = Cache::remember('converted_leads', 300, fn() => Lead::where('status', 'converted')->count());

        // Leads by Status
        $leadStatuses = Cache::remember('lead_status_data', 300, function () {
            return Lead::select('status', DB::raw('count(*) as count'))
                ->groupBy('status')
                ->get();
        });

        $leadStatusLabels = $leadStatuses->pluck('status')->toArray();
        $leadStatusCounts = $leadStatuses->pluck('count')->toArray();

        // Leads by Service Required
        $leadServices = Cache::remember('lead_service_data', 300, function () {
            return Lead::select('service_required', DB::raw('count(*) as count'))
                ->groupBy('service_required')
                ->get();
        });

        $leadServiceLabels = $leadServices->pluck('service_required')->toArray();
        $leadServiceCounts = $leadServices->pluck('count')->toArray();

        // Follow-Up Timeline (Calendar View)
        $followUps = Lead::whereNotNull('follow_up_date')
    ->selectRaw('customer_name as id, follow_up_date as start, customer_name as title') // Replacing id
    ->orderBy('follow_up_date', 'asc')
    ->get()
    ->toArray();

    

        return view('dashboard', compact(
            'totalLeads',
            'convertedLeads',
            'leadStatusLabels', 'leadStatusCounts',
            'leadServiceLabels', 'leadServiceCounts',
            'followUps'
        ));
    }

    public function getData()
    {
        $leadStatuses = Lead::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();
            
        $leadServices = Lead::select('service_required', DB::raw('count(*) as count'))
            ->groupBy('service_required')
            ->get();
            
        $followUps = Lead::whereNotNull('follow_up_date')
            ->get()
            ->map(function ($lead) {
                return [
                    'title' => $lead->customer_name,
                    'start' => $lead->follow_up_date->format('Y-m-d'),
                ];
            });
            
        return response()->json([
            'leadStatusLabels' => $leadStatuses->pluck('status')->toArray(),
            'leadStatusCounts' => $leadStatuses->pluck('count')->toArray(),
            'leadServiceRequiredLabels' => $leadServices->pluck('service_required')->toArray(),
            'leadServiceRequiredCounts' => $leadServices->pluck('count')->toArray(),
            'followUps' => $followUps,
        ]);
    }
}
