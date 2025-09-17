<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\AttendanceLogController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\OvertimeLetterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    if (Auth::user()->role === 'gm') {
        return view('dashboard.gm');
    } elseif (Auth::user()->role === 'akuntansi') {
        return view('dashboard.akuntansi');
    } else {
        return view('dashboard.karyawan');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['can:view-general-manager-dashboard'])->group(function () {
        Route::resource('employees', EmployeeController::class);
        Route::resource('positions', PositionController::class);
    });

    Route::middleware(['can:view-accounting-dashboard'])->group(function () {
        Route::resource('payrolls', PayrollController::class);
    });

    Route::middleware(['can:view-employee-dashboard'])->group(function () {
        Route::get('attendance', [AttendanceLogController::class, 'index'])->name('attendance.index');
        Route::post('attendance/checkin', [AttendanceLogController::class, 'checkIn'])->name('attendance.checkin');
        Route::post('attendance/checkout', [AttendanceLogController::class, 'checkOut'])->name('attendance.checkout');
        Route::resource('leave-requests', LeaveRequestController::class);
        Route::resource('overtime-letters', OvertimeLetterController::class);
    });
});

require __DIR__.'/auth.php';
