<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <i class="fas fa-calendar-alt me-2 text-primary-600"></i>{{ __('Leave & Overtime Requests') }}
            </h2>
            <div class="flex space-x-3">
                <button onclick="openRequestModal('leave')" class="btn-primary ripple-effect">
                    <i class="fas fa-calendar-plus me-2"></i>Request Leave
                </button>
                <button onclick="openRequestModal('overtime')" class="btn-secondary ripple-effect">
                    <i class="fas fa-clock me-2"></i>Request Overtime
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics Overview -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-lg rounded-lg border-l-4 border-blue-500 animate__animated animate__fadeInUp">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-calendar-check text-blue-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 truncate">Leave Balance</p>
                                <p class="text-2xl font-bold text-gray-900">12</p>
                                <p class="text-xs text-gray-500">Days remaining</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-lg border-l-4 border-green-500 animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 truncate">Approved</p>
                                <p class="text-2xl font-bold text-gray-900">
                                    {{ $leaveRequests->where('status', 'approved')->count() + $overtimeLetters->where('status', 'approved')->count() }}
                                </p>
                                <p class="text-xs text-gray-500">This year</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-lg border-l-4 border-yellow-500 animate__animated animate__fadeInUp animate__delay-2s">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 truncate">Pending</p>
                                <p class="text-2xl font-bold text-gray-900">
                                    {{ $leaveRequests->where('status', 'pending')->count() + $overtimeLetters->where('status', 'pending')->count() }}
                                </p>
                                <p class="text-xs text-gray-500">Awaiting approval</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-lg border-l-4 border-purple-500 animate__animated animate__fadeInUp animate__delay-3s">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-business-time text-purple-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 truncate">Overtime Hours</p>
                                <p class="text-2xl font-bold text-gray-900">24</p>
                                <p class="text-xs text-gray-500">This month</p>
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
                                <input type="text" id="searchRequests" placeholder="Search requests..." 
                                       class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-300">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <select id="typeFilter" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-300">
                                <option value="">All Types</option>
                                <option value="leave">Leave Requests</option>
                                <option value="overtime">Overtime Requests</option>
                            </select>
                            <select id="statusFilter" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-300">
                                <option value="">All Status</option>
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                            <button class="btn-secondary ripple-effect" onclick="resetFilters()">
                                <i class="fas fa-undo me-2"></i>Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Requests Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6" id="requestsGrid">
                <!-- Leave Requests -->
                @foreach($leaveRequests as $request)
                <div class="request-card bg-white overflow-hidden shadow-lg rounded-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 animate__animated animate__fadeInUp" 
                     data-type="leave" data-status="{{ $request->status }}" data-search="{{ strtolower($request->reason) }}">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-calendar-alt text-blue-600 text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Leave Request</h3>
                                    <p class="text-sm text-gray-500">{{ $request->leave_type }}</p>
                                </div>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $request->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                   ($request->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                <i class="fas fa-{{ $request->status === 'approved' ? 'check' : ($request->status === 'rejected' ? 'times' : 'clock') }} me-1"></i>
                                {{ ucfirst($request->status) }}
                            </span>
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Start Date:</span>
                                <span class="font-medium text-gray-900">{{ $request->start_date->format('M d, Y') }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">End Date:</span>
                                <span class="font-medium text-gray-900">{{ $request->end_date->format('M d, Y') }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Duration:</span>
                                <span class="font-medium text-primary-600">{{ $request->start_date->diffInDays($request->end_date) + 1 }} days</span>
                            </div>
                            
                            @if($request->reason)
                            <div class="pt-3 border-t border-gray-100">
                                <span class="text-sm text-gray-600">Reason:</span>
                                <p class="text-sm text-gray-800 mt-1">{{ $request->reason }}</p>
                            </div>
                            @endif

                            <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                                <span class="text-xs text-gray-500">
                                    <i class="fas fa-calendar me-1"></i>
                                    Applied {{ $request->created_at->diffForHumans() }}
                                </span>
                                <div class="flex space-x-2">
                                    @if($request->status === 'pending')
                                    <button onclick="editRequest('leave', {{ $request->id }})" 
                                            class="text-blue-600 hover:text-blue-800 transition-colors duration-200">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="cancelRequest('leave', {{ $request->id }})" 
                                            class="text-red-600 hover:text-red-800 transition-colors duration-200">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- Overtime Requests -->
                @foreach($overtimeLetters as $request)
                <div class="request-card bg-white overflow-hidden shadow-lg rounded-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 animate__animated animate__fadeInUp" 
                     data-type="overtime" data-status="{{ $request->status }}" data-search="{{ strtolower($request->reason) }}">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-clock text-purple-600 text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Overtime Request</h3>
                                    <p class="text-sm text-gray-500">Extra Work Hours</p>
                                </div>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $request->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                   ($request->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                <i class="fas fa-{{ $request->status === 'approved' ? 'check' : ($request->status === 'rejected' ? 'times' : 'clock') }} me-1"></i>
                                {{ ucfirst($request->status) }}
                            </span>
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Date:</span>
                                <span class="font-medium text-gray-900">{{ $request->overtime_date->format('M d, Y') }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Duration:</span>
                                <span class="font-medium text-primary-600">{{ $request->hours }} hours</span>
                            </div>
                            
                            @if($request->reason)
                            <div class="pt-3 border-t border-gray-100">
                                <span class="text-sm text-gray-600">Purpose:</span>
                                <p class="text-sm text-gray-800 mt-1">{{ $request->reason }}</p>
                            </div>
                            @endif

                            <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                                <span class="text-xs text-gray-500">
                                    <i class="fas fa-calendar me-1"></i>
                                    Applied {{ $request->created_at->diffForHumans() }}
                                </span>
                                <div class="flex space-x-2">
                                    @if($request->status === 'pending')
                                    <button onclick="editRequest('overtime', {{ $request->id }})" 
                                            class="text-blue-600 hover:text-blue-800 transition-colors duration-200">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="cancelRequest('overtime', {{ $request->id }})" 
                                            class="text-red-600 hover:text-red-800 transition-colors duration-200">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @if($leaveRequests->isEmpty() && $overtimeLetters->isEmpty())
            <div class="text-center py-12">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-calendar-alt text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No requests found</h3>
                <p class="text-gray-500 mb-6">Start by creating your first leave or overtime request.</p>
                <div class="flex justify-center space-x-4">
                    <button onclick="openRequestModal('leave')" class="btn-primary ripple-effect">
                        <i class="fas fa-calendar-plus me-2"></i>Request Leave
                    </button>
                    <button onclick="openRequestModal('overtime')" class="btn-secondary ripple-effect">
                        <i class="fas fa-clock me-2"></i>Request Overtime
                    </button>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Request Modal -->
    <div id="requestModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center">
        <div class="bg-white rounded-lg p-8 m-4 max-w-md w-full max-h-screen overflow-y-auto animate__animated animate__fadeInUp">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold text-gray-900" id="modalTitle">Create Request</h3>
                <button onclick="closeRequestModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <form id="requestForm" method="POST">
                @csrf
                <div id="modalContent">
                    <!-- Content will be dynamically loaded -->
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeRequestModal()" class="btn-secondary">Cancel</button>
                    <button type="submit" class="btn-primary" id="submitBtn">Submit Request</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        // Filter functionality
        document.getElementById('searchRequests').addEventListener('input', filterRequests);
        document.getElementById('typeFilter').addEventListener('change', filterRequests);
        document.getElementById('statusFilter').addEventListener('change', filterRequests);

        function filterRequests() {
            const searchTerm = document.getElementById('searchRequests').value.toLowerCase();
            const typeFilter = document.getElementById('typeFilter').value;
            const statusFilter = document.getElementById('statusFilter').value;
            const cards = document.querySelectorAll('.request-card');

            cards.forEach(card => {
                const type = card.dataset.type;
                const status = card.dataset.status;
                const search = card.dataset.search;
                
                const matchesSearch = search.includes(searchTerm);
                const matchesType = !typeFilter || type === typeFilter;
                const matchesStatus = !statusFilter || status === statusFilter;
                
                if (matchesSearch && matchesType && matchesStatus) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function resetFilters() {
            document.getElementById('searchRequests').value = '';
            document.getElementById('typeFilter').value = '';
            document.getElementById('statusFilter').value = '';
            filterRequests();
        }

        // Modal functions
        function openRequestModal(type) {
            const modal = document.getElementById('requestModal');
            const modalTitle = document.getElementById('modalTitle');
            const modalContent = document.getElementById('modalContent');
            const form = document.getElementById('requestForm');

            if (type === 'leave') {
                modalTitle.textContent = 'Request Leave';
                form.action = '/leave-requests';
                modalContent.innerHTML = `
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Leave Type</label>
                            <select name="leave_type" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500">
                                <option value="">Select leave type</option>
                                <option value="annual">Annual Leave</option>
                                <option value="sick">Sick Leave</option>
                                <option value="emergency">Emergency Leave</option>
                                <option value="maternity">Maternity Leave</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                            <input type="date" name="start_date" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                            <input type="date" name="end_date" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Reason</label>
                            <textarea name="reason" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500" placeholder="Explain the reason for your leave request..."></textarea>
                        </div>
                    </div>
                `;
            } else if (type === 'overtime') {
                modalTitle.textContent = 'Request Overtime';
                form.action = '/overtime-letters';
                modalContent.innerHTML = `
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Overtime Date</label>
                            <input type="date" name="overtime_date" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Duration (hours)</label>
                            <input type="number" name="hours" min="1" max="12" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500" placeholder="Number of overtime hours">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Purpose</label>
                            <textarea name="reason" rows="3" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500" placeholder="Explain the purpose of overtime work..."></textarea>
                        </div>
                    </div>
                `;
            }

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeRequestModal() {
            const modal = document.getElementById('requestModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function editRequest(type, id) {
            // Implementation for editing requests
            alert('Edit functionality will be implemented');
        }

        function cancelRequest(type, id) {
            if (confirm('Are you sure you want to cancel this request?')) {
                // Implementation for canceling requests
                alert('Cancel functionality will be implemented');
            }
        }

        // Form submission
        document.getElementById('requestForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Submitting...';
            submitBtn.disabled = true;
        });

        // Initialize animations
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.request-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
    @endpush
</x-app-layout>