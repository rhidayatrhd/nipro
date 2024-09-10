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
        Schema::create('master_configs', function (Blueprint $table) {
            $table->id();
            $table->string('key1');
            $table->string('key2')->nullable();
            $table->string('key3')->nullable();
            $table->integer('seq');
            $table->string('string1');
            $table->string('string2')->nullable();
            $table->string('string3')->nullable();
            $table->string('string4')->nullable();
            $table->string('string5')->nullable();
            $table->string('string6')->nullable();
            $table->string('string7')->nullable();
            $table->string('flag')->nullable();
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
        Schema::dropIfExists('master_configs');
    }
};
