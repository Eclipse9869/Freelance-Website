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
        $query = Project::query();

        // Cek apakah ada input pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $project = $query->paginate(5);
        $project->appends(request()->query());

        //AJAX
        // if ($request->ajax()) {
        //     return view('recruiter.partials.project-list', compact('project'))->render();
        // }

        // $project = Project::all();
        // $project = Project::paginate(5);
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

        return redirect()->route('projects.create')->with('success', 'Project berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
