<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('view-general-manager-dashboard', function (User $user) {
            return $user->role === 'gm';
        });

        Gate::define('view-accounting-dashboard', function (User $user) {
            return $user->role === 'akuntansi';
        });

        Gate::define('view-employee-dashboard', function (User $user) {
            return $user->role === 'karyawan';
        });

        // GM: Full CRUD
        Gate::define('manage-employee', fn(User $user) => $user->role === 'gm');
        Gate::define('manage-position', fn(User $user) => $user->role === 'gm');
        Gate::define('manage-attendance', fn(User $user) => $user->role === 'gm');
        Gate::define('manage-payroll', fn(User $user) => $user->role === 'gm');

        // Akuntansi: CRUD Payroll, view Employee, akses Absensi & Profil
        Gate::define('crud-payroll', fn(User $user) => $user->role === 'akuntansi');
        Gate::define('view-employee', fn(User $user) => $user->role === 'akuntansi');
        Gate::define('access-attendance', fn(User $user) => $user->role === 'akuntansi');
        Gate::define('access-profile', fn(User $user) => $user->role === 'akuntansi');

        // Karyawan: Kelola data diri, absensi, ajukan cuti/lembur, lihat slip gaji & riwayat
        Gate::define('update-profile', fn(User $user) => $user->role === 'karyawan');
        Gate::define('check-attendance', fn(User $user) => $user->role === 'karyawan');
        Gate::define('request-leave', fn(User $user) => $user->role === 'karyawan');
        Gate::define('request-overtime', fn(User $user) => $user->role === 'karyawan');
        Gate::define('view-payroll-history', fn(User $user) => $user->role === 'karyawan');
    }
}
