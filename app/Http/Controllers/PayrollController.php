<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $employeeId = $request->input('employee_id');
            $periodStart = $request->input('period_start');
            $periodEnd = $request->input('period_end');

            $attendanceCount = \App\Models\AttendanceLog::where('employee_id', $employeeId)
                ->whereBetween('check_in', [$periodStart, $periodEnd])
                ->count();

            if ($attendanceCount <= 20) {
                return back()->with('error', 'Payroll hanya bisa digenerate jika kehadiran > 20 hari.');
            }

            // Proses generate payroll (dummy, sesuaikan dengan kebutuhan)
            $payroll = Payroll::create([
                'employee_id' => $employeeId,
                'period_start' => $periodStart,
                'period_end' => $periodEnd,
                'total_salary' => 0 // Hitung sesuai kebutuhan
            ]);

            return redirect()->route('payrolls.show', $payroll)->with('success', 'Payroll berhasil digenerate.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payroll $payroll)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payroll $payroll)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payroll $payroll)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payroll $payroll)
    {
        //
    }
}
