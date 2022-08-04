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

        Schema::create('people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('nickname')->nullable();
            $table->string('slug');
            $table->string('gender', 15)->nullable();
            $table->dateTime('dob');
            $table->integer('birth_month');
            $table->integer('birth_day');
            $table->integer('age');
            $table->string('county')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country');
            $table->string('professional');
            $table->string('image');
            $table->string('typology', 4);
            $table->string('timezone')->nullable();
            $table->string('timezone_description')->nullable();
            $table->string('died_on')->nullable();
            $table->integer('views')->default(0);
            $table->string('last_view_ip', 100)->nullable();
            $table->string('published', 30)->default('unpublished');
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
        Schema::dropIfExists('people');
    }
};
