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
        Schema::create('request_forms', function (Blueprint $table) {
            $table->id();
            $table->string('regis_id');
            $table->foreignId('user_id');
            $table->string('appl_id')->nullable();
            $table->timestamp('required_date')->nullable();
            $table->foreignId('form_id')->default(0);
            $table->string('request_type');
            $table->text('reason_request')->nullable();
            $table->string('rel_flag')->nullable();
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
        Schema::dropIfExists('request_forms');
    }
};
