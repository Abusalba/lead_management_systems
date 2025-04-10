<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    // public function index()
    // {
    //     $leads = Lead::all();

    //     return view('admin.leads.index', compact('leads'));
    // }

    public function index(Request $request)
{
    $query = Lead::query();

    // Search Leads by Name, Email, Status, or Service
    if ($request->has('search') && !empty($request->search)) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('customer_name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('status', 'LIKE', "%{$search}%")
                ->orWhere('service_required', 'LIKE', "%{$search}%");
        });
    }

    // Filter Leads by Status
    if ($request->has('status') && !empty($request->status)) {
        $query->where('status', $request->status);
    }

    // Filter Leads by Assigned User
    if ($request->has('assigned_to') && !empty($request->assigned_to)) {
        $query->where('assigned_to', $request->assigned_to);
    }

    //Sorting
    $sortColumn = $request->get('sort_by', 'received_date'); // Default: received_date
    $sortOrder = $request->get('sort_order', 'desc'); // Default: desc
    $query->orderBy($sortColumn, $sortOrder);

    $leads = $query->paginate(10);

    // Get Users for Assignment Filter
    $users = User::all();

    return view('admin.leads.index', compact('leads', 'users'));
}


    public function create()
    {
        $users = User::all();
        return view('admin.leads.create', compact('users'));
    }

    public function store(Request $request)
    {

        
        $request->validate([
            'received_date' => 'required',
            'follow_up_date' => 'required',
            'customer_name' => 'required',
            'email' => 'required',
            'country' => 'required',
            'contact_number' => 'required',
            'website' => 'required',
            'lead_source' => 'required',
            'service_required' => 'required',
            'status' => 'required',
            'linkedin_profile' => 'required',
            'assigned_to' => 'required',
        ]);

        Lead::create($request->all());

        return redirect()->route('leads.index');
    }

    public function show(Lead $lead)
    {
        return view('admin.leads.show', compact('lead'));
    }

    public function edit( $lead_id)
    {
        $lead = Lead::findOrFail($lead_id);
        $users = User::all();
        return view('admin.leads.edit', compact('lead', 'users'));
    }

    public function update(Request $request,  $lead_id)
    {
        $lead = Lead::findOrFail($lead_id);
        $request->validate([
            'received_date' => 'required',
            'follow_up_date' => 'required',
            'customer_name' => 'required',
            'email' => 'required',
            'country' => 'required',
            'contact_number' => 'required',
            'website' => 'required',
            'lead_source' => 'required',
            'service_required' => 'required',
            'status' => 'required',
            'linkedin_profile' => 'required',
            'assigned_to' => 'required',
        ]);

        $lead->update($request->all());

        return redirect()->route('leads.index');
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();

        return redirect()->route('admin.leads.index');
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $leads = Lead::where('customer_name', 'like', '%'.$search.'%')->get();

        return view('admin.leads.index', compact('leads'));
    }

    public function filter(Request $request)
    {
        $filter = $request->get('filter');
        $leads = Lead::where('status', $filter)->get();

        return view('admin.leads.index', compact('leads'));
    }

    public function assign(Lead $lead)
    {

        $users = User::all();

        return view('admin.leads.assign', compact('lead', 'users'));
    }

    public function assignUser(Request $request, Lead $lead)
    {
        $request->validate([
            'assigned_to' => 'required',
        ]);

        $lead->update($request->all());

        return redirect()->route('admin.leads.index');
    }
    
}
