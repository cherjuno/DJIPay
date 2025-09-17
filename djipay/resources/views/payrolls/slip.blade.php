@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card mt-4">
        <div class="card-header bg-danger text-white">
            Slip Gaji
        </div>
        <div class="card-body">
            <h5 class="card-title">Periode: {{ $payroll->periode }}</h5>
            <p><strong>Nama:</strong> {{ $payroll->employee->user->name }}</p>
            <p><strong>Jabatan:</strong> {{ $payroll->employee->position->name }}</p>
            <p><strong>Gaji Pokok:</strong> Rp{{ number_format($payroll->employee->position->gaji_pokok,0,',','.') }}</p>
            <p><strong>Lembur:</strong> Rp{{ number_format($payroll->lembur,0,',','.') }}</p>
            <p><strong>Potongan:</strong> Rp{{ number_format($payroll->potongan,0,',','.') }}</p>
            <hr>
            <h4 class="text-danger">Total Gaji: Rp{{ number_format($payroll->total,0,',','.') }}</h4>
        </div>
    </div>
</div>
@endsection
