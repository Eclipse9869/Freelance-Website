<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Category;
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
        $category = Category::all();
        return view('admin.job', compact('job', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all(); // Ambil semua kategori
        return view('admin.add-job', compact('category'));
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
        ]);

        // Simpan ke database
        Job::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'category_job_id' => $request->category,
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
        $category = Category::all();
        return view('admin.add-job', compact('job', 'category'));
        
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
        ]);
    
        // $job = Job::findOrFail($id);
        $job->update([
            'name' => $request->name,
            'desc' => $request->desc,
            'category_job_id' => $request->category,
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
