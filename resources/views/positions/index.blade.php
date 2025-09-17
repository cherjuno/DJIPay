<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <i class="fas fa-briefcase me-2 text-primary-600"></i>{{ __('Positions Management') }}
            </h2>
            <a href="{{ route('positions.create') }}" class="btn-primary ripple-effect">
                <i class="fas fa-plus me-2"></i>Add New Position
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-lg rounded-lg border-l-4 border-blue-500 animate__animated animate__fadeInUp">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-briefcase text-blue-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 truncate">Total Positions</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $positions->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-lg border-l-4 border-green-500 animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-users text-green-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 truncate">Active Employees</p>
                                <p class="text-3xl font-bold text-gray-900">{{ \App\Models\Employee::count() }}</p>
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
                                <p class="text-sm font-medium text-gray-500 truncate">Departments</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $positions->groupBy('department')->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search and Filter Section -->
            <div class="bg-white overflow-hidden shadow-lg rounded-lg mb-6 animate__animated animate__fadeInUp animate__delay-3s">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <input type="text" id="searchPositions" placeholder="Search positions..." 
                                       class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-300">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <select id="departmentFilter" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-300">
                                <option value="">All Departments</option>
                                @foreach($positions->groupBy('department') as $department => $group)
                                    <option value="{{ $department }}">{{ $department }}</option>
                                @endforeach
                            </select>
                            <button class="btn-secondary ripple-effect" onclick="resetFilters()">
                                <i class="fas fa-undo me-2"></i>Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Positions Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="positionsGrid">
                @foreach($positions as $position)
                <div class="position-card bg-white overflow-hidden shadow-lg rounded-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 animate__animated animate__fadeInUp" 
                     data-department="{{ $position->department }}" data-name="{{ strtolower($position->name) }}">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-gradient-to-r from-primary-500 to-primary-600 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-id-badge text-white text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $position->name }}</h3>
                                    <p class="text-sm text-gray-500">{{ $position->department }}</p>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('positions.edit', $position) }}" 
                                   class="w-8 h-8 bg-blue-100 hover:bg-blue-200 rounded-lg flex items-center justify-center transition-colors duration-200 ripple-effect">
                                    <i class="fas fa-edit text-blue-600 text-sm"></i>
                                </a>
                                <form action="{{ route('positions.destroy', $position) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-8 h-8 bg-red-100 hover:bg-red-200 rounded-lg flex items-center justify-center transition-colors duration-200 ripple-effect"
                                            onclick="return confirm('Are you sure you want to delete this position?')">
                                        <i class="fas fa-trash text-red-600 text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Base Salary:</span>
                                <span class="font-semibold text-green-600">Rp {{ number_format($position->base_salary, 0, ',', '.') }}</span>
                            </div>
                            
                            @if($position->description)
                            <div>
                                <span class="text-sm text-gray-600">Description:</span>
                                <p class="text-sm text-gray-800 mt-1 line-clamp-3">{{ $position->description }}</p>
                            </div>
                            @endif

                            <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                                <span class="text-xs text-gray-500">
                                    <i class="fas fa-users me-1"></i>
                                    {{ $position->employees_count ?? 0 }} Employees
                                </span>
                                <span class="text-xs text-gray-500">
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ $position->created_at->format('M Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @if($positions->isEmpty())
            <div class="text-center py-12">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-briefcase text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No positions found</h3>
                <p class="text-gray-500 mb-6">Get started by creating your first position.</p>
                <a href="{{ route('positions.create') }}" class="btn-primary ripple-effect">
                    <i class="fas fa-plus me-2"></i>Create Position
                </a>
            </div>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
        // Search functionality
        document.getElementById('searchPositions').addEventListener('input', function() {
            filterPositions();
        });

        document.getElementById('departmentFilter').addEventListener('change', function() {
            filterPositions();
        });

        function filterPositions() {
            const searchTerm = document.getElementById('searchPositions').value.toLowerCase();
            const departmentFilter = document.getElementById('departmentFilter').value.toLowerCase();
            const cards = document.querySelectorAll('.position-card');

            cards.forEach(card => {
                const name = card.dataset.name;
                const department = card.dataset.department.toLowerCase();
                
                const matchesSearch = name.includes(searchTerm);
                const matchesDepartment = !departmentFilter || department.includes(departmentFilter);
                
                if (matchesSearch && matchesDepartment) {
                    card.style.display = 'block';
                    card.classList.add('animate__fadeIn');
                } else {
                    card.style.display = 'none';
                    card.classList.remove('animate__fadeIn');
                }
            });
        }

        function resetFilters() {
            document.getElementById('searchPositions').value = '';
            document.getElementById('departmentFilter').value = '';
            filterPositions();
        }

        // Add loading animation
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.position-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
    @endpush
</x-app-layout>