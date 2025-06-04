@extends('layouts.app')

@section('content')
<h1>Peminjaman Lab</h1>
@if(Auth::user()->role === 'admin')
    <a href="{{ route('borrowings.create') }}" class="btn btn-primary mb-3">Buat Permintaan</a>
@endif
<table class="table">
    <thead>
        <tr>
            <th>Lab</th>
            <th>User</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Tujuan</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($borrowings as $borrowing)
        <tr>
            <td>{{ $borrowing->lab->name }}</td>
            <td>{{ $borrowing->user->name }}</td>
            <td>{{ $borrowing->borrow_date->format('d-m-Y') }}</td>
            <td>{{ $borrowing->return_date ? $borrowing->return_date->format('d-m-Y') : '-' }}</td>
            <td>{{ $borrowing->purpose }}</td>
            <td>{{ ucfirst($borrowing->status) }}</td>
            <td>
                @if(Auth::user()->role === 'admin' && $borrowing->status === 'pending')
                <a href="{{ route('borrowings.approve', $borrowing) }}" class="btn btn-success btn-sm">Setujui</a>
                <a href="{{ route('borrowings.reject', $borrowing) }}" class="btn btn-danger btn-sm">Tolak</a>
                @endif
                <form action="{{ route('borrowings.destroy', $borrowing) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Yakin ingin menghapus permintaan peminjaman ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
