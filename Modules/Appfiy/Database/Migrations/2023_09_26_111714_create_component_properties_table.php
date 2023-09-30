<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appfiy_component_style_properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('component_id')->unsigned();
            $table->string('name',255);
            $table->string('input_type',255);
            $table->string('value',255);
            $table->longText('default_value')->nullable();
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();
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
        Schema::dropIfExists('appfiy_component_style_properties');
    }
}
