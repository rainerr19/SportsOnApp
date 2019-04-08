<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterestsUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interests_user', function (Blueprint $table) {
            $table->unsignedInteger('interest_id');
            $table->unsignedInteger('user_id');
            
            //relation interes usuario
            $table->foreign('interest_id')
                ->references('id')
                ->on('interests')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['user_id', 'interest_id']);
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interests_user');
    }
}
