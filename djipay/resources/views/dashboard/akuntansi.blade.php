<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('DJIPay - Accounting Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card text-white bg-danger">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class="card-title">Total Payroll</h4>
                                    <h2>{{ \App\Models\Payroll::count() }}</h2>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-money-bill fa-2x"></i>
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
                                    <h4 class="card-title">Gaji Bulan Ini</h4>
                                    <h2>Rp {{ number_format(\App\Models\Payroll::whereMonth('created_at', now()->month)->sum('total_salary'), 0, ',', '.') }}</h2>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-chart-line fa-2x"></i>
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
                                    <h4 class="card-title">Karyawan Aktif</h4>
                                    <h2>{{ \App\Models\Employee::count() }}</h2>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-users fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-danger text-white">
                            <h5 class="card-title mb-0">Quick Actions - Accounting</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="{{ route('payrolls.index') }}" class="btn btn-danger btn-lg w-100 mb-2">
                                        <i class="fas fa-money-bill"></i><br>Kelola Payroll
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ route('employees.index') }}" class="btn btn-outline-danger btn-lg w-100 mb-2">
                                        <i class="fas fa-users"></i><br>View Karyawan
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ route('attendance.index') }}" class="btn btn-outline-danger btn-lg w-100 mb-2">
                                        <i class="fas fa-clock"></i><br>Data Absensi
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
                    <h4 class="mt-4 mb-2 text-danger">Grafik Pengeluaran Gaji Bulanan</h4>
                    <canvas id="attendanceChartAkuntansi" height="100"></canvas>
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
                    <script>
                        const ctxAkuntansi = document.getElementById('attendanceChartAkuntansi').getContext('2d');
                        new Chart(ctxAkuntansi, {
                            type: 'line',
                            data: {
                                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                                datasets: [{
                                    label: 'Pengeluaran Gaji (Juta Rupiah)',
                                    data: [150, 165, 180, 200, 170, 190, 210, 180, 160, 200, 190, 180],
                                    backgroundColor: 'rgba(220,53,69,0.2)',
                                    borderColor: 'rgba(220,53,69,1)',
                                    borderWidth: 2,
                                    fill: true
                                }]
                            },
                            options: {
                                scales: {
                                    y: { beginAtZero: true }
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>