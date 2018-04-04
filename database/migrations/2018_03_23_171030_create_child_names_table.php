<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_names', function (Blueprint $table) {
            $table->string('id');
            $table->primary('id');
            $table->string('device_id');
            $table->foreign('device_id')->references('id')->on('devices');
            $table->string('name');
            $table->char('label', 2)->nullable();
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
        Schema::dropIfExists('child_names');
    }
}
