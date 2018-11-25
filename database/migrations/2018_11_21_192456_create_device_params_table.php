<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeviceParamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_params', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('os');
            $table->string('browser_type');
            $table->string('browser_width');
            $table->string('browser_height');
            $table->string('screen_width');
            $table->string('screen_height');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('device_params');
    }
}
