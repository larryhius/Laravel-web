<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create(Project $project)
    {
        return view('tasks.create', compact('project'));
    }

    public function store(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $project->tasks()->create([
            'name' => $request->name,
            'status' => 'pending',
        ]);

        return redirect()->route('projects.show', $project)
                         ->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function updateStatus(Task $task, Request $request)
    {
        $task->status = $task->status === 'completed' ? 'pending' : 'completed';
        $task->save();

        return back()->with('success', 'Status tugas berhasil diperbarui.');
    }
}
