@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Daftar Proyek</h1>

    <!-- Form Pencarian -->
    <form method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari proyek berdasarkan nama" value="{{ request('search') }}">
            <input type="date" name="deadline" class="form-control" value="{{ request('deadline') }}">
            <button class="btn btn-outline-secondary" type="submit">Cari</button>
        </div>
    </form>

    <!-- Pesan Sukses -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tombol Tambah Proyek -->
    <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">Tambah Proyek</a>

    <!-- Daftar Proyek -->
    @if ($projects->isEmpty())
        <div class="alert alert-info">Belum ada proyek yang tersedia.</div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Proyek</th>
                    <th>Deskripsi</th>
                    <th>Tenggat Waktu</th>
                    <th>Kemajuan (%)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    @php
                        $totalTasks = $project->tasks->count();
                        $completedTasks = $project->tasks->where('status', 'completed')->count();
                        $progress = $totalTasks > 0 ? ($completedTasks / $totalTasks) * 100 : 0;
                    @endphp
                    <tr>
                        <td>
                            <!-- Link to project details -->
                            <a href="{{ route('projects.show', $project) }}">{{ $project->name }}</a>
                        </td>            
                        <td>{{ $project->description }}</td>
                        <td>{{ $project->deadline }}</td>
                        <td>
                            <div class="progress">
                            <div class="progress-bar" 
                                     role="progressbar" 
                                     style="width: {{ $progress }}%; background-color: {{ $progress >= 75 ? 'green' : ($progress >= 50 ? 'yellow' : 'red') }};" 
                                     aria-valuenow="{{ $progress }}" 
                                     aria-valuemin="0" 
                                     aria-valuemax="100">
                                    {{ round($progress) }}%
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('projects.edit', $project) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus proyek ini?');">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif


@endsection
