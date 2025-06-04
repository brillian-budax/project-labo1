@extends('layouts.app')

@section('content')
<h1>Buat Permintaan Peminjaman Lab</h1>
<form action="{{ route('borrowings.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="lab" class="form-label">Pilih Lab</label>
        <select name="lab_id" id="lab" class="form-select" required>
            @foreach($labs as $lab)
            <option value="{{ $lab->id }}">{{ $lab->name }} ({{ $lab->location }})</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="borrow_date" class="form-label">Tanggal Pinjam</label>
        <input type="date" name="borrow_date" id="borrow_date" class="form-control" required min="{{ date('Y-m-d') }}">
    </div>
    <div class="mb-3">
        <label for="return_date" class="form-label">Tanggal Kembali</label>
        <input type="date" name="return_date" id="return_date" class="form-control" min="{{ date('Y-m-d') }}">
    </div>
    <div class="mb-3">
        <label for="purpose" class="form-label">Tujuan</label>
        <textarea name="purpose" id="purpose" rows="3" class="form-control" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Kirim Permintaan</button>
</form>
@endsection
