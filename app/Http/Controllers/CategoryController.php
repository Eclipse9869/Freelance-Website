<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $category = Category::all();
        return view('admin.category-job', compact('category'));

    }public function home()
    {
        //
        $category = Category::all();
        return view('applicant.dashboard', compact('category'));
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/category', $imageName);
        }

        // Simpan ke database
        Category::create([
            'name' => $request->name,
            'image' => $imageName,
        ]);

        return redirect()->route('category-job')->with('success', 'Category successfully added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $jobIds = $category->jobs()->pluck('id');

        $query = Project::whereHas('job', function ($q) use ($jobIds) {
            $q->whereIn('job.id', $jobIds);
        })->with('job');

        // Jika ada keyword pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $project = $query->paginate(5);
        $project->appends($request->query()); // menjaga query string saat pagination

        return view('applicant.category-project', compact('project', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $category = Category::findOrFail($id);
    
        if ($request->hasFile('image')) {
            // Optional: hapus gambar lama
            if ($category->image && Storage::exists('public/category/' . $category->image)) {
                Storage::delete('public/category/' . $category->image);
            }
    
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/category', $imageName);
            $category->image = $imageName;
        }
    
        $category->name = $request->name;
        $category->save();
    
        return redirect()->route('category-job')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
