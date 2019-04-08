<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('apellidos')->nullable();
            $table->date('birthdate')->nullable();// formato->	YYYY-MM-DD
            $table->double('cel',11,1)->nullable();
            $table->string('img',128)->default('perfilDefault.jpg');
            $table->string('email')->unique();
            $table->enum('sexo',['Masculino', 'Femenino'])->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_has_interest');
    }
}
