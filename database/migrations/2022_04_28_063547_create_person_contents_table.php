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
        Schema::create('person_contents', function (Blueprint $table) {
            $table->foreignId('person_id')
            ->references('id')->on('people')
            ->onDelete('cascade');
            $table->text('quotes')->nullable();
            $table->longText('content');
            $table->text('hobbies')->nullable();
            $table->string('worth')->nullable();
            $table->string('website')->nullable();
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
        Schema::dropIfExists('person_contents');
    }
};
