<?php

use Illuminate\Database\Seeder;
use App\Type;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipo = Type::create([
            'nombre' => 'Todo',
            'estatud' => '0'
        ]);
        $tipo = Type::create([
            'nombre' => 'Quincalleria',
            'estatud' => '1'
        ]);
    }
}
