@extends('layouts.app')
@section('content')
<div class="container">
    <h3 class="mt-4 mb-3">Riwayat Lembur</h3>
    <table class="table table-bordered">
        <thead class="bg-danger text-white">
            <tr>
                <th>Tanggal Pengajuan</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Keterangan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($overtimeLetters as $lembur)
            <tr>
                <td>{{ $lembur->created_at->format('d-m-Y') }}</td>
                <td>{{ $lembur->jam_mulai }}</td>
                <td>{{ $lembur->jam_selesai }}</td>
                <td>{{ $lembur->keterangan }}</td>
                <td>{{ $lembur->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
