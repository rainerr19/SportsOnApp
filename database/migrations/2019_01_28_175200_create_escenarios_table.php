<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEscenariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escenarios', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->boolean('paga'); 	
            $table->string('name');
            $table->enum('tipo',['Futbol', 'Baloncesto', 'Voleibol', 'Mixta'])
                ->default('Futbol');
            $table->mediumText('caracteristicas');
            $table->mediumText('detalles')->nullable(); 	
            $table->string('direccion');
            $table->double('latitud',11,7);
            $table->double('longitud',11,7); 		
            $table->string('horaBaned')->nullable();
            $table->string('horaOcupada')->nullable();
            $table->string('img',128)->nullable();
            $table->dateTime('saveTime');
            $table->timestamps();
            //relation 
            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('escenarios');
    }
}
