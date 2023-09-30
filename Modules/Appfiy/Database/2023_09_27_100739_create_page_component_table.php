<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageComponentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appfiy_page_component', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('page_id')->unsigned()->nullable();
            $table->unsignedBigInteger('component_id')->unsigned()->nullable();
            $table->integer('position')->default(0);
            $table->timestamps();
            $table->foreign('page_id')->references('id')->on('appfiy_page')->onDelete('cascade');
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
        Schema::dropIfExists('appfiy_page_component');
    }
}
