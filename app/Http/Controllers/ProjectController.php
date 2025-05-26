<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = Project::where('users_id', auth()->id());

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $project = $query->paginate(5);
        $project->appends(request()->query());

        $job = Job::all();
        return view('recruiter.dashboard-recruiter', compact('job', 'project'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $job = Job::all();
        return view('recruiter.add-project', compact('job'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'name' => 'required|string|max:45',
            'desc' => 'required|string|max:500',
            'req_edu' => 'nullable|string|max:15',
            'amount_min' => 'required|numeric',
            'amount_max' => 'required|numeric',
            'deadline' => 'required|date',
            'job' => 'required|array',
            'job.*' => 'exists:job,id',
        ]);

        $project = Project::create([
            'name' => $validated['name'],
            'desc' => $validated['desc'],
            'req_edu' => $validated['req_edu'],
            'amount_min' => $validated['amount_min'],
            'amount_max' => $validated['amount_max'],
            'deadline' => $validated['deadline'],
            'users_id' => Auth::id(),
        ]);
        // dd($project);

        $project->job()->attach($validated['job']);

        return redirect()->route('projects.index')->with('success', 'Project berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project->load('job');
        return view('recruiter.detail-project', compact('project'));
    }

    // public function showDashboard(Project $projects)
    // {
    //     $projects->load('job');
    //     return view('applicant.category-project', compact('projects'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
        if ($project->users_id !== auth()->id()) {
            abort(403);
        }
    
        $job = Job::all();
        $selectedJobs = $project->job->pluck('id')->toArray();
    
        return view('recruiter.add-project', compact('project', 'job', 'selectedJobs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
        if ($project->users_id !== auth()->id()) {
            abort(403);
        }
    
        $validated = $request->validate([
            'name' => 'required|string|max:45',
            'desc' => 'required|string|max:500',
            'req_edu' => 'nullable|string|max:15',
            'amount_min' => 'required|numeric',
            'amount_max' => 'required|numeric',
            'deadline' => 'required|date',
            'job' => 'required|array',
            'job.*' => 'exists:job,id',
        ]);
    
        $project->update($validated);
        $project->job()->sync($validated['job']);
    
        return redirect()->route('projects.index')->with('success', 'Project berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }

    public function dashboard(Request $request)
    {
        //
        $query = Project::with('users');

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $project = $query->paginate(5);
        $project->appends(request()->query());

        $job = Job::all();
        return view('applicant.all-category', compact('job', 'project'));
    }
}
