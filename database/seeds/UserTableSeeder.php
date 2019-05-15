<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class,7)->create();
        //$user->assignRole('usuario');
        $adminUser = App\User::create([
            'name'     => 'Super-admin',
            'email'    => 'admin@admin.com',
            'password' => bcrypt('123456'),
            'remember_token' => str_random(10),
            'verify'   => 1,
        ]);
        $adminUser->assignRole('super-admin');
        $admin= App\User::create([
            'name'     => 'admin',
            'email'    => 'pruebasAd@pruebas.com',
            'password' => bcrypt('123456'),
            'remember_token' => str_random(10),
        ]);
        $admin->assignRole('admin');
        $test= App\User::create([
            'name'     => 'test',
            'email'    => 'test@test.com',
            'password' => bcrypt('123456'),
            'remember_token' => str_random(10),
            'verify'   => 1,
        ]);
        $test->assignRole('usuario');
        $test= App\User::create([
            'name'     => 'test2',
            'email'    => 'test2@test.com',
            'password' => bcrypt('123456'),
            'remember_token' => str_random(10),
        ]);
        $test->assignRole('usuario');
        $test= App\User::create([
            'name'     => 'test3',
            'email'    => 'test3@test.com',
            'password' => bcrypt('123456'),
            'remember_token' => str_random(10),
        ]);
        $test->assignRole('usuario');
       
    }
}
