@extends('layouts.app')
@section('content')
<div class="container">
    <h3 class="mt-4 mb-3">Riwayat Payroll</h3>
    <table class="table table-bordered">
        <thead class="bg-danger text-white">
            <tr>
                <th>Periode</th>
                <th>Gaji Pokok</th>
                <th>Lembur</th>
                <th>Potongan</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payrolls as $payroll)
            <tr>
                <td>{{ $payroll->periode }}</td>
                <td>Rp{{ number_format($payroll->employee->position->gaji_pokok,0,',','.') }}</td>
                <td>Rp{{ number_format($payroll->lembur,0,',','.') }}</td>
                <td>Rp{{ number_format($payroll->potongan,0,',','.') }}</td>
                <td>Rp{{ number_format($payroll->total,0,',','.') }}</td>
                <td><a href="{{ route('payrolls.show', $payroll) }}" class="btn btn-sm btn-danger">Lihat Slip</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
