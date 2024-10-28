@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Project Details -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h2 class="card-title">{{ $project->name }}</h2>
                <p class="text-muted">{{ $project->description }}</p>
                <p><strong>Tenggat Waktu:</strong> {{ $project->deadline }}</p>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Tasks Section -->
        <div class="card shadow-sm">
            <div class="card-header">
                <h3>Tugas</h3>
            </div>
            <div class="card-body">
            <form action="{{ route('tasks.store', $project) }}" method="POST" class="mb-4 p-3 border rounded shadow-sm">
                @csrf
                <div class="mb-3">
                    <label for="taskName" class="form-label">Task Name</label>
                    <div class="input-group">
                        <input 
                            type="text" 
                            id="taskName" 
                            name="name" 
                            class="form-control" 
                            placeholder="Enter task name" 
                            required
                        >
                        <button type="submit" class="btn btn-primary">Add Task</button>
                    </div>
                </div>
            </form>

                @if ($project->tasks->isEmpty())
                    <p>Belum ada tugas untuk proyek ini.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Tugas</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($project->tasks as $task)
                                <tr>
                                    <td>{{ $task->name }}</td>
                                    <td>
                                        <span class="badge bg-{{ $task->status === 'completed' ? 'success' : 'warning' }}">
                                            {{ ucfirst($task->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{ route('tasks.toggleStatus', $task) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-secondary">
                                                {{ $task->status === 'completed' ? 'Tandai sebagai Pending' : 'Tandai sebagai Selesai' }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @php
                        $totalTasks = $project->tasks->count();
                        $completedTasks = $project->tasks->where('status', 'completed')->count();
                        $progress = $totalTasks > 0 ? ($completedTasks / $totalTasks) * 100 : 0;
                    @endphp

                    <div class="progress mt-3">
                        <div class="progress-bar bg-primary" role="progressbar" 
                             style="width: {{ $progress }}%;" 
                             aria-valuenow="{{ $progress }}" 
                             aria-valuemin="0" 
                             aria-valuemax="100">
                            {{ round($progress) }}%
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <a href="{{ route('projects.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Proyek</a>
    </div>
@endsection
