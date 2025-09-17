@extends('layouts.app')
@section('content')
<div class="container">
    <h3 class="mt-4 mb-3">Riwayat Cuti/Izin</h3>
    <table class="table table-bordered">
        <thead class="bg-danger text-white">
            <tr>
                <th>Tanggal Pengajuan</th>
                <th>Jenis</th>
                <th>Keterangan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leaveRequests as $leave)
            <tr>
                <td>{{ $leave->created_at->format('d-m-Y') }}</td>
                <td>{{ $leave->jenis }}</td>
                <td>{{ $leave->keterangan }}</td>
                <td>{{ $leave->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
