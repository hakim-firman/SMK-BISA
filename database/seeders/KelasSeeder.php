<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kelas')->insert([
            ['name' => 'XI TKJ 1'],
            ['name' => 'XI PSPT'],
            ['name' => 'XI TKJ 2'],
            ['name' => 'XI AKKL '],
            ['name' => 'XI PM '],
            
        ]);
    }
}
