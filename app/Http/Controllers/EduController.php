<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\EduLevel;
use Illuminate\Http\Request;

class EduController extends Controller
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
        $eduLevels = EduLevel::all(); // ambil semua level pendidikan
        return view('profile.add-edu', compact('eduLevels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'education_level_id' => 'required|exists:education_level,id',
            'school_name' => 'required|string|max:255',
            'major' => 'required|string|max:255',
            'start' => 'required|string|max:4',
            'end' => 'required|string|max:4',
            'desc' => 'required|string',
        ]);        

        // Simpan ke database
        Education::create([
            'school_name' => $request->school_name,
            'major' => $request->major,
            'start' => $request->start,
            'end' => $request->end,
            'desc' => $request->desc,
            'education_level_id' => $request->education_level_id,
            'users_id' => auth()->id(),
        ]);

        return redirect()->route('profile.edit')->with('success', 'Study successfully added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Education $education)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Education $id)
    // {
    //     //
    //     $edu = Education::findOrFail($id);
    //     $eduLevels = EduLevel::all();
    //     return view('profile.add-edu', compact('edu', 'eduLevels'));
    // }

    public function edit(Education $edu)
    {
        $eduLevels = EduLevel::all();
        return view('profile.add-edu', compact('edu', 'eduLevels'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Education $edu)
    {
        $request->validate([
            'education_level_id' => 'required|exists:education_level,id',
            'school_name' => 'required|string|max:255',
            'major' => 'required|string|max:255',
            'start' => 'required|string|max:4',
            'end' => 'required|string|max:4',
            'desc' => 'required|string',
        ]);

        $edu->update([
            'school_name' => $request->school_name,
            'major' => $request->major,
            'start' => $request->start,
            'end' => $request->end,
            'desc' => $request->desc,
            'education_level_id' => $request->education_level_id,
        ]);

        return redirect()->route('profile.edit')->with('success', 'Study successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Education $edu)
    {
        $edu->delete();
        return redirect()->route('profile.edit')->with('success', 'Study successfully deleted!');
    }

}
