<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('loanDateStart');
            $table->dateTime('loanDateEnd');
            $table->dateTime('DateLoan');
            $table->enum('estado',['Prestado','Por Confirmar', 'Rechazado',  'Devolución']);
            $table->mediumText('detalles')->nullable();
            // $table->integer('calificacion')->nullable();
            // $table->mediumText('comentario')->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('escenario_id');
           
            //relation 
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('prestamos');
    }
}
