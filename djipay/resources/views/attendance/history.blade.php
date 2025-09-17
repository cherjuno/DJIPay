@extends('layouts.app')
@section('content')
<div class="container">
    <h3 class="mt-4 mb-3">Riwayat Absensi</h3>
    <table class="table table-bordered">
        <thead class="bg-danger text-white">
            <tr>
                <th>Tanggal</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendanceLogs as $log)
            <tr>
                <td>{{ $log->tanggal }}</td>
                <td>{{ $log->check_in }}</td>
                <td>{{ $log->check_out }}</td>
                <td>{{ $log->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
