@extends('layouts.app')

@section('content')
<h1>Laboratorium</h1>
<a href="{{ route('labs.create') }}" class="btn btn-primary mb-3">Tambah Lab</a>
<table class="table">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Lokasi</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($labs as $lab)
        <tr>
            <td>{{ $lab->name }}</td>
            <td>{{ $lab->location }}</td>
            <td>{{ $lab->description }}</td>
            <td>
                <a href="{{ route('labs.edit', $lab) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('labs.destroy', $lab) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus lab ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
