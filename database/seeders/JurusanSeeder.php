<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jurusan::create(['jurusan' => 'ASE']);
        Jurusan::create(['jurusan' => 'AIS']);
        Jurusan::create(['jurusan' => 'OAA']);
    
    }
}
