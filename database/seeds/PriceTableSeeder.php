<?php

use Illuminate\Database\Seeder;

class PriceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Price::create([
        'startHour' => '00:00:00',
        'endHour' => '24:00:00',
        'dias' => 'Lunes',
        'hourPrice' => '100000',
        'color' => 'green', 
        'escenario_id' => 1 , 
        ]);
        App\Price::create([
            'startHour' => '00:00:00',
        'endHour' => '24:00:00',
        'dias' => 'Martes',
        'hourPrice' => '100000',
        'color' => 'green', 
        'escenario_id' => 1 , 
        ]);
        App\Price::create([
            'startHour' => '00:00:00',
        'endHour' => '24:00:00',
        'dias' => 'Miercoles',
        'hourPrice' => '100000',
        'color' => 'green', 
        'escenario_id' => 1 , 
        ]);
        App\Price::create([
            'startHour' => '00:00:00',
        'endHour' => '24:00:00',
        'dias' => 'Jueves',
        'hourPrice' => '100000',
        'color' => 'green', 
        'escenario_id' => 1 , 
        ]);
        App\Price::create([
            'startHour' => '00:00:00',
        'endHour' => '14:00:00',
        'dias' => 'Viernes',
        'hourPrice' => '100000',
        'color' => 'green', 
        'escenario_id' => 1 , 
        ]);
        App\Price::create([
            'startHour' => '14:00:00',
        'endHour' => '24:00:00',
        'dias' => 'Viernes',
        'hourPrice' => '121000',
        'color' => 'gray', 
        'escenario_id' => 1 , 
        ]);
        App\Price::create([
            'startHour' => '00:00:00',
        'endHour' => '24:00:00',
        'dias' => 'Sabado',
        'hourPrice' => '100000',
        'color' => 'green', 
        'escenario_id' => 1 , 
        ]);
        App\Price::create([
        'startHour' => '00:00:00',
        'endHour' => '24:00:00',
        'dias' => 'Domingo',
        'hourPrice' => '120000',
        'color' => 'yellow',
        'escenario_id' => 1 , 
        ]);
        App\Price::create([
            'startHour' => '00:00:00',
            'endHour' => '24:00:00',
            'dias' => 'Festivos',
            'hourPrice' => '120000',
            'color' => 'yellow',
            'escenario_id' => 1 , 
            ]);
        //

        App\Price::create([
            'startHour' => '00:00:00',
        'endHour' => '24:00:00',
        'dias' => 'Lunes',
        'hourPrice' => '100000',
        'color' => 'blue', 
        'escenario_id' => 2 , 
        ]);
        App\Price::create([
            'startHour' => '00:00:00',
        'endHour' => '24:00:00',
        'dias' => 'Martes',
        'hourPrice' => '100000',
        'color' => 'blue', 
        'escenario_id' => 2 , 
        ]);
        App\Price::create([
            'startHour' => '00:00:00',
        'endHour' => '24:00:00',
        'dias' => 'Miercoles',
        'hourPrice' => '100000',
        'color' => 'blue', 
        'escenario_id' => 2 , 
        ]);
        App\Price::create([
            'startHour' => '00:00:00',
        'endHour' => '24:00:00',
        'dias' => 'Jueves',
        'hourPrice' => '100000',
        'color' => 'blue', 
        'escenario_id' => 2 , 
        ]);
        App\Price::create([
            'startHour' => '00:00:00',
        'endHour' => '24:00:00',
        'dias' => 'Viernes',
        'hourPrice' => '100000',
        'color' => 'blue', 
        'escenario_id' => 2 , 
        ]);
        App\Price::create([
            'startHour' => '00:00:00',
        'endHour' => '24:00:00',
        'dias' => 'Sabado',
        'hourPrice' => '100000',
        'color' => 'blue', 
        'escenario_id' => 2 , 
        ]);
        App\Price::create([
        'startHour' => '00:00:00',
        'endHour' => '24:00:00',
        'dias' => 'Domingo',
        'hourPrice' => '110000',
        'color' => 'red',
        'escenario_id' => 2 , 
        ]);
        App\Price::create([
            'startHour' => '00:00:00',
            'endHour' => '24:00:00',
            'dias' => 'Festivos',
            'hourPrice' => '110000',
            'color' => 'red',
            'escenario_id' => 2 , 
            ]);
        //
        
    }
}
