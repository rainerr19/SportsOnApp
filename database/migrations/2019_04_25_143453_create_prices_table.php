<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->increments('id');
            $table->time('startHour');
            $table->time('endHour');
            $table->enum('dias',['Lunes','Martes', 'Miercoles', 'Jueves', 'Viernes',
                'Sabado', 'Domingo', 'Festivos']);
            $table->string('hourPrice');
            $table->string('color');
            $table->unsignedInteger('escenario_id');
            $table->foreign('escenario_id')->references('id')->on('escenarios')
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
        Schema::dropIfExists('prices');
    }
}
