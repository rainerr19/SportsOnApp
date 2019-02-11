<?php

use Faker\Generator as Faker;

$factory->define(App\Escenario::class, function (Faker $faker) {
    return [
        'name'            => $faker-> company,
        'paga'            => $faker-> boolean($chanceOfGettingTrue = 50),
        'tipo'            => $faker-> randomElement(['Futbol', 'Baloncesto',
        'Voleibol', 'Mixta']),
        'caracteristicas' => $faker-> sentence,
        'direccion'       => $faker-> address,
        'latitud'         => $faker-> latitude,
        'longitud'        => $faker-> longitude,
        'detalles'        => $faker-> sentence,
        'horaBaned'       => '2300-06L2300-06M2300-06I2300-06J2300-06V2300-06S2300-06D',
        'horaOcupada'     => null,
        'img'             => $faker-> imageUrl($width = 1280, $height = 720),
        'saveTime'        => $faker-> dateTimeAD($max = 'yesterday',
             $timezone = 'America/Bogota'),
        'user_id'         => rand(1,7)

       //1280×720  //720x420
        //   $table->integer('user_id')->unsigned();
        //  $table->foreign('user_id')
        //     ->references('id')->on('users')
        //     ->onDelete('cascade');
        //     ->onUpdate('cascade');
        
    ];
});
