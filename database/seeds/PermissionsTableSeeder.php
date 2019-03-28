<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
         //Users
        Permission::create(['name'  => 'lista_user']);
        
        Permission::create(['name'  => 'detalle_user']);
        
        Permission::create(['name'  => 'edit_user']);
        
        Permission::create(['name'  => 'eliminar_user']);

        //Roles
        Permission::create(['name'  => 'lista_role']);
        
        Permission::create(['name'  => 'crear_role']);
        
        Permission::create(['name'  => 'edit_role']);
        
        Permission::create(['name'  => 'eliminar_role']);

             //canchas o escenarios
        Permission::create(['name'  => 'lista_escenario']);
        
        Permission::create(['name'  => 'detalle_escenario']);
        
        Permission::create(['name'  => 'crear_escenario']);
        
        Permission::create(['name'  => 'guardar_escenario']);

        Permission::create(['name'  => 'edit_escenario']);

        Permission::create(['name'  => 'update_escenario']);
        
        Permission::create(['name'  => 'eliminar_escenario']);

        // ********* se crean los roles *****
        //
        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());
        //
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(['lista_user','detalle_user','edit_user','lista_role',
        'edit_role','lista_escenario', 'detalle_escenario', 
        'edit_escenario','crear_escenario','eliminar_escenario']);
        // 
        $role = Role::create(['name' => 'usuario'])
            ->givePermissionTo(['lista_escenario', 'detalle_escenario',]);


    }
}
