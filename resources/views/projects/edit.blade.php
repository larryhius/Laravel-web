@extends('layouts.app')

@section('content')
    <h1>Edit Proyek: {{ $project->name }}</h1>

    <form action="{{ route('projects.update', $project) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama Proyek</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $project->name }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description">{{ $project->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="deadline" class="form-label">Tenggat Waktu</label>
            <input type="date" class="form-control" id="deadline" name="deadline" value="{{ $project->deadline }}">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
