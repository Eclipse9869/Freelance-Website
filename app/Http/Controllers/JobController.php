<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $job = Job::all();
        return view('admin.job', compact('job'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'required|string',
            'category' => 'required|string',
        ]);

        // Simpan ke database
        Job::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'category' => $request->category,
        ]);

        return redirect()->route('job')->with('success', 'Job successfully added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $job = Job::findOrFail($id);
        return view('admin.add-job', compact('job'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'required|string',
            'category' => 'required|string',
        ]);
    
        // $job = Job::findOrFail($id);
        $job->update([
            'name' => $request->name,
            'desc' => $request->desc,
            'category' => $request->category,
        ]);
        // dd($request->all());
    
        return redirect()->route('job')->with('success', 'Job successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $id)
    {
        //
    }
}
