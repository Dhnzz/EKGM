<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Responden;

class RespondenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Responden::create([
            'name' => 'Responden 1',
            'phone' => '0812345678',
            'birth_date' => '01/01/0001',
        ]);
    }
}
