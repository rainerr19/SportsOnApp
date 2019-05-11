<?php

use Illuminate\Database\Seeder;

class InterestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Interest::create([
            'name'=> 'Futbol',//
        ]);
        App\Interest::create([
            'name'=> 'Baloncesto',//
        ]);
    }
}
