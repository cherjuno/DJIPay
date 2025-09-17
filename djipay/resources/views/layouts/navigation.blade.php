<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-lg" style="background: linear-gradient(135deg, var(--primary-color) 0%, #ff4757 100%) !important;">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 rtl:space-x-reverse ripple-effect">
                        <i class="fas fa-coins text-white text-2xl"></i>
                        <span class="self-center text-xl font-bold whitespace-nowrap text-white">DJIPay</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @can('view-general-manager-dashboard')
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="nav-item-modern">
                            <i class="fas fa-chart-line me-2"></i>{{ __('GM Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('employees.index')" :active="request()->routeIs('employees.index')" class="nav-item-modern">
                            <i class="fas fa-users me-2"></i>{{ __('Employees') }}
                        </x-nav-link>
                        <x-nav-link :href="route('positions.index')" :active="request()->routeIs('positions.index')" class="nav-item-modern">
                            <i class="fas fa-briefcase me-2"></i>{{ __('Positions') }}
                        </x-nav-link>
                    @endcan
                    @can('view-accounting-dashboard')
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="nav-item-modern">
                            <i class="fas fa-calculator me-2"></i>{{ __('Accounting Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('payrolls.index')" :active="request()->routeIs('payrolls.index')" class="nav-item-modern">
                            <i class="fas fa-money-bill-wave me-2"></i>{{ __('Payrolls') }}
                        </x-nav-link>
                    @endcan
                    @can('view-employee-dashboard')
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="nav-item-modern">
                            <i class="fas fa-home me-2"></i>{{ __('My Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('attendance.index')" :active="request()->routeIs('attendance.index')" class="nav-item-modern">
                            <i class="fas fa-clock me-2"></i>{{ __('Attendance') }}
                        </x-nav-link>
                    @endcan
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-white/20 text-sm leading-4 font-medium rounded-lg text-white bg-white/10 hover:bg-white/20 focus:outline-none transition-all duration-300 ease-in-out backdrop-blur-sm ripple-effect">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-white text-sm"></i>
                                </div>
                                <div>{{ Auth::user()->name }}</div>
                            </div>

                            <div class="ms-2">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="bg-white/95 backdrop-blur-sm rounded-lg shadow-xl border border-gray-200">
                            <x-dropdown-link :href="route('profile.edit')" class="flex items-center space-x-2 hover:bg-primary-50 transition-colors duration-200">
                                <i class="fas fa-user-edit text-primary-600"></i>
                                <span>{{ __('Profile') }}</span>
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();"
                                        class="flex items-center space-x-2 hover:bg-red-50 text-red-600 transition-colors duration-200">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>{{ __('Log Out') }}</span>
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-white/80 hover:text-white hover:bg-white/10 focus:outline-none focus:bg-white/10 focus:text-white transition-all duration-300 ease-in-out ripple-effect">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white/10 backdrop-blur-sm">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:bg-white/10 border-white/20">
                <i class="fas fa-home me-2"></i>{{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-white/20">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-white/70">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-white hover:bg-white/10 border-white/20">
                    <i class="fas fa-user-edit me-2"></i>{{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="text-white hover:bg-red-500/20 border-white/20">
                        <i class="fas fa-sign-out-alt me-2"></i>{{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
