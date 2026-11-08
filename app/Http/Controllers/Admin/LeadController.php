<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class LeadController extends Controller
{
    /**
     * Display a listing of the contact leads.
     */
    public function index(Request $request): Response
    {
        $query = Lead::latest('id');

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('service_type', 'like', "%{$search}%");
            });
        }

        $leads = $query->paginate(15)->withQueryString();

        $statusCounts = [
            'all' => Lead::count(),
            'new' => Lead::where('status', 'new')->count(),
            'contacted' => Lead::where('status', 'contacted')->count(),
            'deal' => Lead::where('status', 'deal')->count(),
            'lost' => Lead::where('status', 'lost')->count(),
        ];

        return Inertia::render('Admin/Leads/Index', [
            'leads' => $leads,
            'statusCounts' => $statusCounts,
            'filters' => $request->only(['status', 'search']),
        ]);
    }

    /**
     * Show the form for creating a new contact lead.
     */
    public function create(): Response
    {
        return Inertia::render('Admin/Leads/Form', [
            'lead' => null,
            'isEdit' => false,
        ]);
    }

    /**
     * Store a newly created contact lead in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'email' => 'nullable|email|max:255',
            'service_type' => 'required|string|max:255',
            'budget' => 'nullable|string|max:100',
            'message' => 'required|string',
            'status' => 'required|in:new,contacted,deal,lost',
            'notes' => 'nullable|string',
        ]);

        $validated['ip_address'] = $request->ip();
        $validated['user_agent'] = $request->userAgent();

        Lead::create($validated);

        return redirect()->route('admin.leads.index')->with('success', 'Kontak baru berhasil ditambahkan.');
    }

    /**
     * Display the specified lead detail.
     */
    public function show(Lead $lead): Response
    {
        return Inertia::render('Admin/Leads/Show', [
            'lead' => $lead,
        ]);
    }

    /**
     * Show the form for editing the specified contact lead.
     */
    public function edit(Lead $lead): Response
    {
        return Inertia::render('Admin/Leads/Form', [
            'lead' => $lead,
            'isEdit' => true,
        ]);
    }

    /**
     * Update the contact lead in storage.
     */
    public function update(Request $request, Lead $lead): RedirectResponse
    {
        // Check if full edit or quick status update
        if ($request->has('name')) {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:30',
                'email' => 'nullable|email|max:255',
                'service_type' => 'required|string|max:255',
                'budget' => 'nullable|string|max:100',
                'message' => 'required|string',
                'status' => 'required|in:new,contacted,deal,lost',
                'notes' => 'nullable|string',
            ]);

            $lead->update($validated);

            return redirect()->route('admin.leads.index')->with('success', 'Data kontak berhasil diperbarui.');
        }

        // Quick status update from Show page
        $validated = $request->validate([
            'status' => 'required|in:new,contacted,deal,lost',
            'notes' => 'nullable|string',
        ]);

        $lead->update($validated);

        return redirect()->back()->with('success', 'Status kontak berhasil diperbarui.');
    }

    /**
     * Remove the specified lead.
     */
    public function destroy(Lead $lead): RedirectResponse
    {
        $lead->delete();

        return redirect()->route('admin.leads.index')->with('success', 'Data kontak berhasil dihapus.');
    }
}
