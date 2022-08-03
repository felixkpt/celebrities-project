<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_user', function (Blueprint $table) {
            $table->foreignId('person_id')
            ->references('id')->on('people')
            ->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('manager_id')->references('id')->on('users');
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
        Schema::dropIfExists('person_user');
    }
};
