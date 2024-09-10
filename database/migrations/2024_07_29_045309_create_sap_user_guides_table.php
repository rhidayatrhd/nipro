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
        Schema::create('sap_user_guides', function (Blueprint $table) {
            $table->id();
            $table->string('module');
            $table->string('submodule');
            $table->foreignId('dept_id');
            $table->string('guideno')->unique();
            $table->string('modulename');
            $table->text('moduledesc');
            $table->string('formlink');
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
        Schema::dropIfExists('sap_user_guides');
    }
};
