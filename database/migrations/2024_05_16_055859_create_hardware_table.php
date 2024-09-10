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
        Schema::create('hardware', function (Blueprint $table) {
            $table->id();
            $table->string('hardware_id')->unique();
            $table->string('asset_id')->nullable();
            $table->foreignId('hardwaregroup_id')->default(0);
            $table->string('name');
            $table->string('model')->nullable();
            $table->string('brand')->nullable();
            $table->foreignId('computer_id')->default(0);
            $table->string('purchyear')->nullable();
            $table->string('username');
            $table->foreignId('dept_id')->default(0);
            $table->foreignId('sect_id')->default(0);
            $table->string('usedfor')->nullable();
            $table->string('hhardware_id')->nullable();
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
        Schema::dropIfExists('hardware');
    }
};
