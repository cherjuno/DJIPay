<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <i class="fas fa-money-bill-wave me-2 text-primary-600"></i>{{ __('Payroll Management') }}
            </h2>
            @can('view-accounting-dashboard')
            <a href="{{ route('payrolls.create') }}" class="btn-primary ripple-effect">
                <i class="fas fa-plus me-2"></i>Generate Payroll
            </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics Overview -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-lg rounded-lg border-l-4 border-green-500 animate__animated animate__fadeInUp">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-dollar-sign text-green-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 truncate">Total Payroll</p>
                                <p class="text-2xl font-bold text-gray-900">
                                    Rp {{ number_format($payrolls->sum('net_salary'), 0, ',', '.') }}
                                </p>
                                <p class="text-xs text-gray-500">This month</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-lg border-l-4 border-blue-500 animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-users text-blue-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 truncate">Employees Paid</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $payrolls->count() }}</p>
                                <p class="text-xs text-gray-500">This month</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-lg border-l-4 border-yellow-500 animate__animated animate__fadeInUp animate__delay-2s">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-chart-line text-yellow-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 truncate">Avg Salary</p>
                                <p class="text-2xl font-bold text-gray-900">
                                    Rp {{ number_format($payrolls->avg('net_salary') ?? 0, 0, ',', '.') }}
                                </p>
                                <p class="text-xs text-gray-500">This month</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-lg border-l-4 border-purple-500 animate__animated animate__fadeInUp animate__delay-3s">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-calendar-alt text-purple-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 truncate">Pay Period</p>
                                <p class="text-lg font-bold text-gray-900">{{ now()->format('M Y') }}</p>
                                <p class="text-xs text-gray-500">Current period</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter and Search -->
            <div class="bg-white overflow-hidden shadow-lg rounded-lg mb-6 animate__animated animate__fadeInUp animate__delay-4s">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <input type="text" id="searchPayrolls" placeholder="Search employees..." 
                                       class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-300">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <select id="periodFilter" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-300">
                                <option value="">All Periods</option>
                                <option value="{{ now()->format('Y-m') }}">{{ now()->format('M Y') }}</option>
                                <option value="{{ now()->subMonth()->format('Y-m') }}">{{ now()->subMonth()->format('M Y') }}</option>
                                <option value="{{ now()->subMonths(2)->format('Y-m') }}">{{ now()->subMonths(2)->format('M Y') }}</option>
                            </select>
                            <select id="statusFilter" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-300">
                                <option value="">All Status</option>
                                <option value="paid">Paid</option>
                                <option value="pending">Pending</option>
                            </select>
                            <button class="btn-secondary ripple-effect" onclick="exportPayrolls()">
                                <i class="fas fa-download me-2"></i>Export
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payroll Records -->
            <div class="bg-white overflow-hidden shadow-lg rounded-lg animate__animated animate__fadeInUp animate__delay-5s">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-list me-2 text-primary-600"></i>Payroll Records
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employee</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Period</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Basic Salary</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Overtime</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deductions</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Net Salary</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="payrollTableBody">
                            @foreach($payrolls as $payroll)
                            <tr class="hover:bg-gray-50 transition-colors duration-200 payroll-row" 
                                data-employee="{{ strtolower($payroll->employee->name) }}" 
                                data-period="{{ $payroll->period }}"
                                data-status="{{ $payroll->status ?? 'paid' }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-gradient-to-r from-primary-500 to-primary-600 flex items-center justify-center">
                                                <span class="text-white font-medium text-sm">
                                                    {{ substr($payroll->employee->name, 0, 2) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $payroll->employee->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $payroll->employee->position->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($payroll->period)->format('M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    Rp {{ number_format($payroll->basic_salary, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    Rp {{ number_format($payroll->overtime_pay, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    Rp {{ number_format($payroll->deductions, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-green-600">
                                    Rp {{ number_format($payroll->net_salary, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle me-1"></i>Paid
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <a href="{{ route('payrolls.show', $payroll) }}" 
                                       class="text-primary-600 hover:text-primary-900 transition-colors duration-200 ripple-effect">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('payrolls.slip', $payroll) }}" 
                                       class="text-blue-600 hover:text-blue-900 transition-colors duration-200 ripple-effect" 
                                       target="_blank">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                    @can('view-accounting-dashboard')
                                    <a href="{{ route('payrolls.edit', $payroll) }}" 
                                       class="text-yellow-600 hover:text-yellow-900 transition-colors duration-200 ripple-effect">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($payrolls->isEmpty())
                <div class="text-center py-12">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-money-bill-wave text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No payroll records found</h3>
                    <p class="text-gray-500 mb-6">Generate payroll for your employees to get started.</p>
                    @can('view-accounting-dashboard')
                    <a href="{{ route('payrolls.create') }}" class="btn-primary ripple-effect">
                        <i class="fas fa-plus me-2"></i>Generate Payroll
                    </a>
                    @endcan
                </div>
                @endif
            </div>

            <!-- Quick Actions for Employee View -->
            @can('view-employee-dashboard')
            @php $myPayroll = $payrolls->where('employee_id', auth()->user()->employee->id)->first(); @endphp
            @if($myPayroll)
            <div class="mt-8 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-8 text-white animate__animated animate__fadeInUp animate__delay-6s">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold mb-2">My Latest Payslip</h3>
                        <p class="text-blue-100">{{ \Carbon\Carbon::parse($myPayroll->period)->format('F Y') }}</p>
                        <div class="mt-4">
                            <p class="text-3xl font-bold">Rp {{ number_format($myPayroll->net_salary, 0, ',', '.') }}</p>
                            <p class="text-blue-100">Net Salary</p>
                        </div>
                    </div>
                    <div class="flex flex-col space-y-3">
                        <a href="{{ route('payrolls.slip', $myPayroll) }}" 
                           class="bg-white text-blue-600 px-6 py-3 rounded-lg font-medium hover:bg-blue-50 transition-colors duration-200 ripple-effect text-center"
                           target="_blank">
                            <i class="fas fa-download me-2"></i>Download Payslip
                        </a>
                        <a href="{{ route('payrolls.show', $myPayroll) }}" 
                           class="border border-white text-white px-6 py-3 rounded-lg font-medium hover:bg-white/10 transition-colors duration-200 ripple-effect text-center">
                            <i class="fas fa-eye me-2"></i>View Details
                        </a>
                    </div>
                </div>
            </div>
            @endif
            @endcan
        </div>
    </div>

    @push('scripts')
    <script>
        // Search and filter functionality
        document.getElementById('searchPayrolls').addEventListener('input', function() {
            filterPayrolls();
        });

        document.getElementById('periodFilter').addEventListener('change', function() {
            filterPayrolls();
        });

        document.getElementById('statusFilter').addEventListener('change', function() {
            filterPayrolls();
        });

        function filterPayrolls() {
            const searchTerm = document.getElementById('searchPayrolls').value.toLowerCase();
            const periodFilter = document.getElementById('periodFilter').value;
            const statusFilter = document.getElementById('statusFilter').value;
            const rows = document.querySelectorAll('.payroll-row');

            rows.forEach(row => {
                const employee = row.dataset.employee;
                const period = row.dataset.period;
                const status = row.dataset.status;
                
                const matchesSearch = employee.includes(searchTerm);
                const matchesPeriod = !periodFilter || period.includes(periodFilter);
                const matchesStatus = !statusFilter || status === statusFilter;
                
                if (matchesSearch && matchesPeriod && matchesStatus) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function exportPayrolls() {
            window.open('/payrolls/export', '_blank');
        }

        // Initialize animations
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('.payroll-row');
            rows.forEach((row, index) => {
                row.style.animationDelay = `${index * 0.05}s`;
                row.classList.add('animate__animated', 'animate__fadeIn');
            });
        });
    </script>
    @endpush
</x-app-layout>