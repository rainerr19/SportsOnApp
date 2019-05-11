<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEscenariosCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escenarios_calendars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->enum('tipo',['Privado','Escuela', 'Evento',  'No disponible'])
                ->default('Privado');
            $table->string('color');
            $table->string('colortxt');
            $table->mediumText('detalles')->nullable();	
            $table->dateTime('start');
            $table->dateTime('end');
            $table->unsignedInteger('user_id');// quien presto esas horas
            $table->unsignedInteger('escenario_id');
            $table->unsignedInteger('prestamo_id');  
            //relation 
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('escenario_id')->references('id')->on('escenarios')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('prestamo_id')->references('id')->on('prestamos')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('escenarios_calendars');
    }
}
