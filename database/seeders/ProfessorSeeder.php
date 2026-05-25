<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfessorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Professor::insert([
            ['nome' => 'Ricardo Almeida' , 'cpf' => '111.111.111-11'],
            ['nome' => 'Helena Costa', 'cpf' => '222.222.222-22'],
            ['nome' => 'Marcos Silveira',  'cpf' => '333.333.333-33'],
        ]);
    }
}
