<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leeds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('specialty');
            $table->string('cellPhone');
            $table->string('description');
            $table->string('photograph');
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
        Schema::dropIfExists('leeds');
    }
}
