<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <i class="fas fa-plus-circle me-2 text-primary-600"></i>{{ __('Create New Position') }}
            </h2>
            <a href="{{ route('positions.index') }}" class="btn-secondary ripple-effect">
                <i class="fas fa-arrow-left me-2"></i>Back to Positions
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg rounded-lg animate__animated animate__fadeInUp">
                <div class="p-8">
                    <form action="{{ route('positions.store') }}" method="POST" id="positionForm">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Position Name -->
                            <div class="md:col-span-2">
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-id-badge me-2 text-primary-600"></i>Position Name *
                                </label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-300 @error('name') border-red-500 @enderror"
                                       placeholder="e.g., Senior Software Engineer">
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Department -->
                            <div>
                                <label for="department" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-building me-2 text-primary-600"></i>Department *
                                </label>
                                <select name="department" id="department" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-300 @error('department') border-red-500 @enderror">
                                    <option value="">Select Department</option>
                                    <option value="Information Technology" {{ old('department') == 'Information Technology' ? 'selected' : '' }}>Information Technology</option>
                                    <option value="Human Resources" {{ old('department') == 'Human Resources' ? 'selected' : '' }}>Human Resources</option>
                                    <option value="Finance" {{ old('department') == 'Finance' ? 'selected' : '' }}>Finance</option>
                                    <option value="Marketing" {{ old('department') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                                    <option value="Operations" {{ old('department') == 'Operations' ? 'selected' : '' }}>Operations</option>
                                    <option value="Sales" {{ old('department') == 'Sales' ? 'selected' : '' }}>Sales</option>
                                    <option value="Customer Service" {{ old('department') == 'Customer Service' ? 'selected' : '' }}>Customer Service</option>
                                    <option value="Other" {{ old('department') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('department')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Base Salary -->
                            <div>
                                <label for="base_salary" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-money-bill-wave me-2 text-primary-600"></i>Base Salary (IDR) *
                                </label>
                                <div class="relative">
                                    <span class="absolute left-3 top-3 text-gray-500">Rp</span>
                                    <input type="number" name="base_salary" id="base_salary" value="{{ old('base_salary') }}" required min="1000000"
                                           class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-300 @error('base_salary') border-red-500 @enderror"
                                           placeholder="5000000">
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Minimum salary: Rp 1,000,000</p>
                                @error('base_salary')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-file-alt me-2 text-primary-600"></i>Job Description
                                </label>
                                <textarea name="description" id="description" rows="4"
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-300 @error('description') border-red-500 @enderror"
                                          placeholder="Describe the role responsibilities, requirements, and qualifications...">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                            <a href="{{ route('positions.index') }}" class="btn-secondary ripple-effect">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn-primary ripple-effect" id="submitBtn">
                                <i class="fas fa-save me-2"></i>Create Position
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Quick Tips Card -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mt-6 animate__animated animate__fadeInUp animate__delay-1s">
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <i class="fas fa-lightbulb text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-blue-900 mb-2">Quick Tips</h3>
                        <ul class="text-sm text-blue-800 space-y-1">
                            <li>• Use clear, specific position titles that reflect the role level</li>
                            <li>• Base salary should align with industry standards and company budget</li>
                            <li>• Include key responsibilities and requirements in the description</li>
                            <li>• Consider the position's place in your organizational hierarchy</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Format currency input
        document.getElementById('base_salary').addEventListener('input', function() {
            let value = this.value.replace(/\D/g, '');
            if (value) {
                // Auto-format with thousands separator (optional visual enhancement)
                let formatted = new Intl.NumberFormat('id-ID').format(value);
                // Note: We keep the raw number in the input for form submission
            }
        });

        // Form validation and submission
        document.getElementById('positionForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Creating...';
            submitBtn.disabled = true;
        });

        // Auto-grow textarea
        document.getElementById('description').addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    </script>
    @endpush
</x-app-layout>