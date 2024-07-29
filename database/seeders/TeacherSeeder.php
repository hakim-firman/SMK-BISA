<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('teachers')->insert([
            ['name' => 'Yusuf Maulana', 'kelas_id' => 1],
            ['name' => 'Danang Subagyo', 'kelas_id' => 2],
            ['name' => 'Dian Pram', 'kelas_id' => 3],
            ['name' => 'Astika Devy', 'kelas_id' => 2],
            // Tambahkan data sesuai kebutuhan
        ]);
    }
}
