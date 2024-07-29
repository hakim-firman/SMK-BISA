<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('students')->insert([
            ['name' => 'Hakim', 'Nis' => '1940', 'kelas_id' => 1],
            ['name' => 'Firman ', 'Nis' => '1922', 'kelas_id' => 1],
            ['name' => 'Irawan', 'Nis' => '1973', 'kelas_id' => 2],
            ['name' => 'Kinanti', 'Nis' => '1987', 'kelas_id' => 3],
           
        ]);
    }
}
