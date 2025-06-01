<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\BidDetail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\Education;
use App\Models\Experience;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = Bid::with(['bidDetails.project'])
            ->where('users_id', auth()->id());

        if ($request->has('search') && $request->search != '') {
            $query->whereHas('bidDetails.project', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $bids = $query->paginate(5);
        $bids->appends($request->query());

        return view('applicant.bid-history', compact('bids'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        $users = auth()->user();
        $educations = $users->educations;
        $experiences = $users->experiences;

        return view('applicant.bid', compact('project', 'users', 'educations', 'experiences'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'cv' => 'required|mimes:pdf|max:2048',
            'cover_letter' => 'required|mimes:pdf|max:2048',
            'amount' => 'required|string',
            'project_id' => 'required|exists:project,id',
        ]);
    
        // Upload CV dan Cover Letter
        $cvPath = $request->file('cv')->store('cv', 'public');
        $coverLetterPath = $request->file('cover_letter')->store('cover_letter', 'public');
    
        // Simpan ke tabel bid
        $bid = Bid::create([
            'status' => 'pending',
            'cv' => $cvPath,
            'job_app_letter' => $coverLetterPath,
            'amount' => preg_replace('/[^\d]/', '', $request->amount), // Hilangkan "Rp." dan titik
            'users_id' => auth()->id(),
        ]);
    
        // Simpan ke tabel bid_details
        BidDetail::create([
            'bid_id' => $bid->id,
            'project_id' => $request->project_id,
        ]);
    
        return redirect()->route('dashboard')->with('success', 'Bid berhasil dikirim.');
    }

    public function showBids(Request $request, Project $project)
    {
        $search = $request->query('search');

        $bids = Bid::with('users', 'bidDetails')
            ->whereHas('bidDetails', function ($query) use ($project) {
                $query->where('project_id', $project->id);
            })
            // Kalau ada search, filter user name dan project name
            ->when($search, function ($query, $search) {
                $query->whereHas('users', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('bidDetails.project', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('recruiter.show-bids', compact('bids', 'project'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Bid $bid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bid $bid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bid $bid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bid $bid)
    {
        //
    }
}
