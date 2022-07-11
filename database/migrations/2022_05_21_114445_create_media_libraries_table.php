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
        Schema::create('media_libraries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
            ->references('id')->on('users');
            $table->string('name')->nullable();
            $table->string('url');
            $table->string('type');
            $table->string('mime');
            $table->string('size');
            $table->string('length')->nullable();
            $table->integer('height')->default(0);
            $table->integer('width')->default(0);
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
        Schema::dropIfExists('media_libraries');
    }
};
