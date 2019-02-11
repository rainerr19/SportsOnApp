<?php

use Illuminate\Database\Seeder;

class AsociadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Asociado::create([
        'user_id'         => 10,
        'user_asociado'   => 11,
        'escenario_id'    => 7]);
    }
}
