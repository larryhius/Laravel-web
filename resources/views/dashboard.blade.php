@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Dashboard</h1>

    {{-- Notifications for Upcoming Deadlines --}}
    <div class="alert alert-warning">
        <h4>Upcoming Deadlines</h4>
        @if ($upcomingProjects->isEmpty())
            <p>No projects with upcoming deadlines.</p>
        @else
            <ul>
                @foreach ($upcomingProjects as $project)
                    <li>
                        <strong>{{ $project->name }}</strong> - 
                        Deadline: {{ \Carbon\Carbon::parse($project->deadline)->format('d M Y') }}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    {{-- Link to Projects --}}
    <a href="{{ route('projects.index') }}" class="btn btn-primary">View All Projects</a>
@endsection
