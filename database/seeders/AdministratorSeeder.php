<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(
            [
            'name' => 'administrator',
            'email' => 'administratoriconnet@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password')
        ])->assignRole('administrator');
    }
}
