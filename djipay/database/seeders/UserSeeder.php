<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Position;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create positions first
        $gmPosition = Position::create([
            'name' => 'General Manager',
            'gaji_pokok' => 15000000
        ]);

        $akuntansiPosition = Position::create([
            'name' => 'Akuntansi',
            'gaji_pokok' => 8000000
        ]);

        $karyawanPosition = Position::create([
            'name' => 'Karyawan',
            'gaji_pokok' => 5000000
        ]);

        // Create GM user
        $gmUser = User::create([
            'name' => 'General Manager',
            'email' => 'gm@djipay.com',
            'password' => Hash::make('password'),
            'role' => 'gm'
        ]);

        Employee::create([
            'user_id' => $gmUser->id,
            'position_id' => $gmPosition->id,
            'nip' => 'GM001',
            'phone' => '081234567890',
            'address' => 'Jakarta',
            'join_date' => now()
        ]);

        // Create Akuntansi user
        $akuntansiUser = User::create([
            'name' => 'Staff Akuntansi',
            'email' => 'akuntansi@djipay.com',
            'password' => Hash::make('password'),
            'role' => 'akuntansi'
        ]);

        Employee::create([
            'user_id' => $akuntansiUser->id,
            'position_id' => $akuntansiPosition->id,
            'nip' => 'AKT001',
            'phone' => '081234567891',
            'address' => 'Jakarta',
            'join_date' => now()
        ]);

        // Create Karyawan user
        $karyawanUser = User::create([
            'name' => 'Karyawan Biasa',
            'email' => 'karyawan@djipay.com',
            'password' => Hash::make('password'),
            'role' => 'karyawan'
        ]);

        Employee::create([
            'user_id' => $karyawanUser->id,
            'position_id' => $karyawanPosition->id,
            'nip' => 'KRY001',
            'phone' => '081234567892',
            'address' => 'Jakarta',
            'join_date' => now()
        ]);
    }
}