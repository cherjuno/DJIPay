@extends('layouts.app')
@section('content')
<div class="container">
    <h3 class="mt-4 mb-3">Banding Absensi</h3>
    <form action="{{ route('attendance.banding') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
        </div>
        <div class="mb-3">
            <label for="alasan" class="form-label">Alasan Banding</label>
            <textarea class="form-control" id="alasan" name="alasan" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-danger">Ajukan Banding</button>
    </form>
</div>
@endsection
