<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(
            [
            'name' => 'Manager 2',
            'email' => 'manager2@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('cek123')
        ])->assignRole('manager');
    }
}
