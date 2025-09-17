<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('DJIPay - Employee Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card bg-danger text-white">
                        <div class="card-body">
                            <h3>Selamat Datang, {{ Auth::user()->name }}!</h3>
                            <p class="mb-0">{{ Auth::user()->employee->position->name ?? 'Karyawan' }} - NIP: {{ Auth::user()->employee->nip ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fas fa-clock fa-3x text-success mb-3"></i>
                            <h5>Check In</h5>
                            <button class="btn btn-success btn-sm" onclick="checkIn()">Masuk</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fas fa-clock-o fa-3x text-warning mb-3"></i>
                            <h5>Check Out</h5>
                            <button class="btn btn-warning btn-sm" onclick="checkOut()">Keluar</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fas fa-calendar-alt fa-3x text-info mb-3"></i>
                            <h5>Ajukan Cuti</h5>
                            <a href="{{ route('leave-requests.create') }}" class="btn btn-info btn-sm">Cuti/Izin</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fas fa-business-time fa-3x text-danger mb-3"></i>
                            <h5>Ajukan Lembur</h5>
                            <a href="{{ route('overtime-letters.create') }}" class="btn btn-danger btn-sm">Lembur</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class="card-title">Kehadiran Bulan Ini</h4>
                                    <h2>{{ Auth::user()->employee ? \App\Models\AttendanceLog::where('employee_id', Auth::user()->employee->id)->whereMonth('check_in', now()->month)->count() : 0 }}</h2>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-calendar-check fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class="card-title">Gaji Pokok</h4>
                                    <h2>Rp{{ number_format(Auth::user()->employee->position->gaji_pokok ?? 0, 0, ',', '.') }}</h2>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-money-bill fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-warning">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class="card-title">Cuti Digunakan</h4>
                                    <h2>{{ Auth::user()->employee ? \App\Models\LeaveRequest::where('employee_id', Auth::user()->employee->id)->where('status', 'approved')->count() : 0 }}</h2>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-calendar-times fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-danger text-white">
                            <h5 class="card-title mb-0">Menu Karyawan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="{{ route('attendance.index') }}" class="btn btn-outline-danger btn-lg w-100 mb-2">
                                        <i class="fas fa-history"></i><br>Riwayat Absensi
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="#" class="btn btn-outline-danger btn-lg w-100 mb-2">
                                        <i class="fas fa-receipt"></i><br>Slip Gaji
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('leave-requests.index') }}" class="btn btn-outline-danger btn-lg w-100 mb-2">
                                        <i class="fas fa-list"></i><br>Status Pengajuan
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-danger btn-lg w-100 mb-2">
                                        <i class="fas fa-user-edit"></i><br>Update Profil
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h4 class="mt-4 mb-2 text-danger">Grafik Kehadiran Saya</h4>
                    <canvas id="attendanceChartKaryawan" height="100"></canvas>
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
                    <script>
                        const ctxKaryawan = document.getElementById('attendanceChartKaryawan').getContext('2d');
                        new Chart(ctxKaryawan, {
                            type: 'doughnut',
                            data: {
                                labels: ['Hadir', 'Tidak Hadir', 'Cuti'],
                                datasets: [{
                                    label: 'Status Kehadiran',
                                    data: [18, 2, 3],
                                    backgroundColor: [
                                        'rgba(40, 167, 69, 0.8)',
                                        'rgba(220, 53, 69, 0.8)',
                                        'rgba(255, 193, 7, 0.8)'
                                    ],
                                    borderColor: [
                                        'rgba(40, 167, 69, 1)',
                                        'rgba(220, 53, 69, 1)',
                                        'rgba(255, 193, 7, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true
                            }
                        });

                        function checkIn() {
                            alert('Fitur Check In akan segera tersedia!');
                        }

                        function checkOut() {
                            alert('Fitur Check Out akan segera tersedia!');
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>