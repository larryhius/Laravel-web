<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return redirect()->route('projects.index');
//});

// Root route - Redirect to dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
})->name('home');

// Dashboard route
Route::get('/dashboard', function () {
    $upcomingProjects = \App\Models\Project::where('deadline', '>=', now())
                        ->orderBy('deadline')
                        ->take(5)
                        ->get();
    return view('dashboard', compact('upcomingProjects'));
})->name('dashboard');

Route::resource('projects', ProjectController::class);
Route::get('projects/{project}/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('projects/{project}/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::patch('/tasks/{task}/toggle-status', [TaskController::class, 'updateStatus'])
    ->name('tasks.toggleStatus');