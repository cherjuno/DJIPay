<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <i class="fas fa-clock me-2 text-primary-600"></i>{{ __('Attendance Management') }}
            </h2>
            <div class="flex items-center space-x-3">
                <div class="text-sm text-gray-600">
                    <i class="fas fa-calendar me-1"></i>{{ now()->format('l, F j, Y') }}
                </div>
                <div class="text-sm text-gray-600" id="currentTime">
                    <i class="fas fa-clock me-1"></i><span id="timeDisplay"></span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Today's Status Card -->
            @php
                $todayAttendance = auth()->user()->employee->attendanceLogs()->whereDate('created_at', today())->first();
                $isCheckedIn = $todayAttendance && !$todayAttendance->check_out_time;
                $isCheckedOut = $todayAttendance && $todayAttendance->check_out_time;
            @endphp

            <div class="bg-gradient-to-r from-primary-500 to-primary-600 overflow-hidden shadow-lg rounded-lg mb-8 animate__animated animate__fadeInDown">
                <div class="p-8 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold mb-2">Today's Attendance</h3>
                            <p class="text-primary-100">Track your work hours efficiently</p>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-bold" id="liveTime"></div>
                            <div class="text-primary-100">{{ now()->timezone('Asia/Jakarta')->format('l') }}</div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                        <!-- Check In Status -->
                        <div class="bg-white/10 backdrop-blur-sm rounded-lg p-6">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-sign-in-alt text-white text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-white/80 text-sm">Check In</p>
                                    <p class="text-white text-xl font-bold">
                                        {{ $todayAttendance?->check_in_time ? $todayAttendance->check_in_time->format('H:i') : '--:--' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Check Out Status -->
                        <div class="bg-white/10 backdrop-blur-sm rounded-lg p-6">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-red-500 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-sign-out-alt text-white text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-white/80 text-sm">Check Out</p>
                                    <p class="text-white text-xl font-bold">
                                        {{ $todayAttendance?->check_out_time ? $todayAttendance->check_out_time->format('H:i') : '--:--' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Work Hours -->
                        <div class="bg-white/10 backdrop-blur-sm rounded-lg p-6">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-hourglass-half text-white text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-white/80 text-sm">Work Hours</p>
                                    <p class="text-white text-xl font-bold" id="workHours">
                                        @if($todayAttendance?->check_in_time)
                                            @if($todayAttendance->check_out_time)
                                                {{ $todayAttendance->check_in_time->diff($todayAttendance->check_out_time)->format('%H:%I') }}
                                            @else
                                                <span id="liveWorkHours">--:--</span>
                                            @endif
                                        @else
                                            --:--
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="mt-8 flex justify-center space-x-4">
                        @if(!$todayAttendance)
                            <button onclick="checkIn()" class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-8 rounded-lg transition-colors duration-200 ripple-effect">
                                <i class="fas fa-sign-in-alt me-2"></i>Check In
                            </button>
                        @elseif($isCheckedIn)
                            <button onclick="checkOut()" class="bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-8 rounded-lg transition-colors duration-200 ripple-effect">
                                <i class="fas fa-sign-out-alt me-2"></i>Check Out
                            </button>
                        @else
                            <div class="bg-gray-500/50 text-white font-bold py-3 px-8 rounded-lg">
                                <i class="fas fa-check me-2"></i>Attendance Complete
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-lg rounded-lg border-l-4 border-green-500 animate__animated animate__fadeInUp">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-calendar-check text-green-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 truncate">This Month</p>
                                <p class="text-2xl font-bold text-gray-900">
                                    {{ auth()->user()->employee->attendanceLogs()->whereMonth('created_at', now()->month)->count() }}
                                </p>
                                <p class="text-xs text-gray-500">Days present</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-lg border-l-4 border-blue-500 animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-clock text-blue-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 truncate">Avg Check In</p>
                                <p class="text-2xl font-bold text-gray-900">08:15</p>
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
                                    <i class="fas fa-exclamation-triangle text-yellow-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 truncate">Late Days</p>
                                <p class="text-2xl font-bold text-gray-900">2</p>
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
                                    <i class="fas fa-hourglass-half text-purple-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 truncate">Total Hours</p>
                                <p class="text-2xl font-bold text-gray-900">168h</p>
                                <p class="text-xs text-gray-500">This month</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Attendance History -->
            <div class="bg-white overflow-hidden shadow-lg rounded-lg animate__animated animate__fadeInUp animate__delay-4s">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900">
                            <i class="fas fa-history me-2 text-primary-600"></i>Recent Attendance
                        </h3>
                        <div class="flex space-x-2">
                            <input type="date" id="dateFilter" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500">
                            <button onclick="exportAttendance()" class="btn-secondary ripple-effect text-sm">
                                <i class="fas fa-download me-2"></i>Export
                            </button>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check In</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check Out</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Work Hours</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="attendanceTableBody">
                                @foreach(auth()->user()->employee->attendanceLogs()->orderBy('created_at', 'desc')->take(10)->get() as $log)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $log->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex items-center space-x-2">
                                            <i class="fas fa-sign-in-alt text-green-500"></i>
                                            <span>{{ $log->check_in_time->format('H:i A') }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @if($log->check_out_time)
                                            <div class="flex items-center space-x-2">
                                                <i class="fas fa-sign-out-alt text-red-500"></i>
                                                <span>{{ $log->check_out_time->format('H:i A') }}</span>
                                            </div>
                                        @else
                                            <span class="text-gray-400">--</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @if($log->check_out_time)
                                            {{ $log->check_in_time->diff($log->check_out_time)->format('%H:%I') }}
                                        @else
                                            <span class="text-yellow-600">In Progress</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($log->check_in_time->format('H:i') <= '08:00')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle me-1"></i>On Time
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <i class="fas fa-exclamation-circle me-1"></i>Late
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Live time updates
        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('en-US', { 
                hour12: false,
                timeZone: 'Asia/Jakarta'
            });
            document.getElementById('timeDisplay').textContent = timeString;
            document.getElementById('liveTime').textContent = timeString;
            
            // Update work hours if checked in
            @if($todayAttendance && $todayAttendance->check_in_time && !$todayAttendance->check_out_time)
                updateWorkHours();
            @endif
        }

        function updateWorkHours() {
            const checkInTime = new Date('{{ $todayAttendance?->check_in_time?->toISOString() }}');
            const now = new Date();
            const diff = now - checkInTime;
            const hours = Math.floor(diff / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            document.getElementById('liveWorkHours').textContent = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}`;
        }

        // Check In function
        async function checkIn() {
            try {
                const response = await fetch('/attendance/check-in', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                if (response.ok) {
                    showNotification('Checked in successfully!', 'success');
                    setTimeout(() => window.location.reload(), 1000);
                } else {
                    showNotification('Failed to check in. Please try again.', 'error');
                }
            } catch (error) {
                showNotification('Network error. Please try again.', 'error');
            }
        }

        // Check Out function
        async function checkOut() {
            try {
                const response = await fetch('/attendance/check-out', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                if (response.ok) {
                    showNotification('Checked out successfully!', 'success');
                    setTimeout(() => window.location.reload(), 1000);
                } else {
                    showNotification('Failed to check out. Please try again.', 'error');
                }
            } catch (error) {
                showNotification('Network error. Please try again.', 'error');
            }
        }

        // Export attendance
        function exportAttendance() {
            window.open('/attendance/export', '_blank');
        }

        // Notification system
        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 p-4 rounded-lg text-white z-50 animate__animated animate__fadeInRight ${
                type === 'success' ? 'bg-green-500' : 'bg-red-500'
            }`;
            notification.innerHTML = `<i class="fas fa-${type === 'success' ? 'check' : 'exclamation-triangle'} me-2"></i>${message}`;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.classList.add('animate__fadeOutRight');
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }

        // Initialize
        setInterval(updateTime, 1000);
        updateTime();

        // Date filter
        document.getElementById('dateFilter').addEventListener('change', function() {
            // Filter attendance table based on selected date
            // This would typically make an AJAX request to filter data
        });
    </script>
    @endpush
</x-app-layout>