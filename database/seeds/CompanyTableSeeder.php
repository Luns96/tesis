<?php

use Illuminate\Database\Seeder;
use App\Company;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $compañia = Company::create([
            'nombre' => 'empresas chen',
            'rif'=>'12345',
            'direccion'=>'Chen',
            'telefono' => '123456',
            'estatud' => '1',
            'type_id' => 1
        ]);
        $compañia = Company::create([
            'nombre' => 'Mega Sol C.A',
            'rif'=>'123451',
            'direccion'=>'Chen',
            'telefono' => '123456',
            'estatud' => '1',
            'type_id' => 2
        ]);
    }
}
