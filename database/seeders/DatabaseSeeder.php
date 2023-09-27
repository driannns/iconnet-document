<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NoSurat;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
            $nosurat = [
                'nosurat' => 0 
            ];
            NoSurat::insert($nosurat);

            $this->call(ROleSeeder::class);
    }
}
