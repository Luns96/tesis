<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reiniciar el cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //Creando los permisos
        $cruds = [
            'create', 
            'show', 
            'edit', 
            'index', 
            'delete'
        ];

        //creando los modelos para los permisos
        $models = [
            'user',
            'role',
            'permission',
            'info',
        ];

        foreach($cruds as $crub){
            foreach($models as $model){
                Permission::create(['name' => $crub.'-'.$model]);
            }
        }


        // Crear los roles y asignar permisos
        $role = Role::create(['name' => 'SuperGerente'])
            ->givePermissionTo(['create-info',
                                'show-info',
                                'edit-info',
                                'index-info',
                                'delete-info',
                                'create-user',
                                'delete-user'
                                ]);
        $role = Role::create(['name' => 'Gerente'])
        ->givePermissionTo(['create-info',
                            'show-info',
                            'edit-info',
                            'index-info',
                            'delete-info',
                            ]);

        $role = Role::create(['name' => 'Administrador']);
        $role->givePermissionTo(Permission::all());
    }
}
