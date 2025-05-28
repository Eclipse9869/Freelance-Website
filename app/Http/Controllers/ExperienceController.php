<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('profile.add-experience');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'company_name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'job_name' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
            'desc' => 'required|string',
            'start' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'end' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
        ]);        

        // Simpan ke database
        Experience::create([
            'company_name' => $request->company_name,
            'type' => $request->type,
            'job_name' => $request->job_name,
            'industry' => $request->industry,
            'desc' => $request->desc,
            'start' => $request->start,
            'end' => $request->end,
            'users_id' => auth()->id(),
        ]);

        return redirect()->route('profile.edit')->with('success', 'Experience successfully added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Experience $experience)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Experience $experience)
    {
        //
        return view('profile.add-experience', compact('experience'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Experience $experience)
    {
        //
        $request->validate([
            'company_name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'job_name' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
            'desc' => 'required|string',
            'start' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'end' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
        ]);

        $experience->update([
            'company_name' => $request->company_name,
            'type' => $request->type,
            'job_name' => $request->job_name,
            'industry' => $request->industry,
            'desc' => $request->desc,
            'start' => $request->start,
            'end' => $request->end,
        ]);

        return redirect()->route('profile.edit')->with('success', 'Experience successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Experience $experience)
    {
        //
        $experience->delete();
        return redirect()->route('profile.edit')->with('success', 'Experience successfully deleted!');
    }
}
