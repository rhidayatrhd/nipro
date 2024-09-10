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
        Schema::create('computer_spesifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cpu_id')->nullable();
            $table->foreignId('hardware_id')->nullable();
            $table->string('pchost')->unique();
            $table->string('netmacadrs')->unique();
            $table->string('netipadrs');
            $table->string('nettype');
            $table->string('netname');
            $table->string('netbrand');
            $table->string('wifimacadrs')->unique();
            $table->string('wifiipadrs');
            $table->string('wifitype');
            $table->string('wifiname');
            $table->string('wifibrand');
            $table->string('comp_type');
            $table->string('comp_model');
            $table->string('comp_sku_no');
            $table->string('comp_user');
            $table->string('comp_user_login');
            $table->string('comp_brand');
            $table->string('ossystem');
            $table->string('osversion');
            $table->string('ostype');
            $table->string('osserialno');
            $table->string('osbrand');
            $table->string('procname'); 
            $table->string('procmodel');
            $table->string('procbrand');
            $table->string('hdd_model');
            $table->string('hdd_size');
            $table->string('hdd_cap');
            $table->string('ram_brand');
            $table->string('ram_size');
            $table->string('ram_cap');
            $table->foreignId('dept_id');
            $table->foreignId('sect_id');
            $table->foreignId('user_id');
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
        Schema::dropIfExists('computer_spesifications');
    }
};
