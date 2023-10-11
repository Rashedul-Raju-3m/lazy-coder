<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentLayoutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appfiy_component_layout', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('component_id')->unsigned()->nullable();
            $table->unsignedBigInteger('layout_type_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('layout_type_id')->references('id')->on('appfiy_layout_type')->onDelete('cascade');
            $table->foreign('component_id')->references('id')->on('appfiy_component')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appfiy_component_layout');
    }
}
