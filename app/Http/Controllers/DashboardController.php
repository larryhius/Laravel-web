<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch projects with deadlines in the future, ordered by the nearest deadline.
        $upcomingProjects = Project::where('deadline', '>=', now())
                                   ->orderBy('deadline', 'asc')
                                   ->take(5)
                                   ->get();

        // Pass the projects to the dashboard view.
        return view('dashboard', compact('upcomingProjects'));
    }
}
