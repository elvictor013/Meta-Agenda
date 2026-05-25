<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Sala::insert([
            ['nome' => 'LAB 01'],
            ['nome' => 'LAB 04'],
            ['nome' => 'Sala 202'],
            ['nome' => 'Auditório Central'],
        ]);
    }
}
