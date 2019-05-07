<?php

use Illuminate\Database\Seeder;

class BusinessHourTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\BusinessHour::create([
            'daysOfWeek'=> '[0,1,2,3,4,5,6,7]',//dias de la semana
            'startTime'=> '00:00:00',
            'endTime'=> '02:00:00',
            'escenario_id' => 1,
        ]);
        App\BusinessHour::create([
            'daysOfWeek'=> '[0,1,2,3,4,5,6,7]',//dias de la semana
            'startTime'=> '06:00:00',
            'endTime'=> '24:00:00',
            'escenario_id' => 1,
        ]);
        App\BusinessHour::create([
            'daysOfWeek'=> '[0,1,2,3,4,5,6,7]',//dias de la semana
            'startTime'=> '06:00:00',
            'endTime'=> '23:00:00',
            'escenario_id' => 2,
        ]);

    }
}
