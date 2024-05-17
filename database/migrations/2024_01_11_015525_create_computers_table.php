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
        Schema::create('computers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cpu_id')->nullable();
            $table->foreignId('hardware_id')->nullable();
            $table->string('pchost')->unique();
            $table->string('name');
            $table->string('pctype');
            $table->string('brand');
            $table->string('model');
            $table->string('processor');
            $table->string('ipadrs');
            $table->string('ram');
            $table->string('hdd');
            $table->string('purchyear')->nullable();
            $table->string('username');
            $table->string('userlevel');
            $table->string('userdept');
            $table->string('useremail');
            $table->string('osystem');
            $table->string('spreadsheet');
            $table->text('usedfor')->nullable();
            $table->boolean('antivirus')->default(0);
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
        Schema::dropIfExists('computers');
    }
};
