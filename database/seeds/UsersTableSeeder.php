<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'nombre' => 'adm',
            'apellido' => 'adm',
            'ci' => '12',
            'telefono'=>'123412345',
            'email' => 'admin@gmail.com',
            'password' => '123456',
            'estatud' => '1',
            'company_id' => 1
        ]);

        $admin->assignRole('Administrador');

        $usuario = User::create([
            'nombre' => 'Fran',
            'apellido' => 'Chen',
            'ci' => '132',
            'telefono'=>'123412345',
            'email' => 'SuperGerente@gmail.com',
            'password' => '123456',
            'estatud' => '1',
            'company_id' => 2
        ]);

        $usuario->assignRole('SuperGerente');
        
        $usuario = User::create([
            'nombre' => 'Lun',
            'apellido' => 'Chen',
            'ci' => '142',
            'telefono'=>'123412345',
            'email' => 'Gerente@gmail.com',
            'password' => '123456',
            'estatud' => '1',
            'company_id' => 2
        ]);
    
        $usuario->assignRole('Gerente');
    }

    
}

