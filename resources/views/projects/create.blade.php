@extends('layouts.app')

@section('content')
    <h1>Tambah Proyek Baru</h1>

    <form action="{{ route('projects.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Proyek</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="mb-3">
            <label for="deadline" class="form-label">Tenggat Waktu</label>
            <input type="date" class="form-control" id="deadline" name="deadline">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
