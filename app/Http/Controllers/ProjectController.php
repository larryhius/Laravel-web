<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::query();

        // Pencarian berdasarkan nama proyek atau tanggal tenggat
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        if ($request->filled('deadline')) {
            $query->whereDate('deadline', $request->deadline);
        }

        $projects = $query->with('tasks')->get();
        
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'deadline' => 'nullable|date',
        ]);

        Project::create($validatedData);
        return redirect()->route('projects.index')->with('success', 'Proyek berhasil ditambahkan.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Proyek berhasil dihapus.');
    }
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }
    
    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'deadline' => 'nullable|date',
        ]);
    
        $project->update($validatedData);
    
        return redirect()->route('projects.index')->with('success', 'Proyek berhasil diperbarui.');
    }
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }
           
}
