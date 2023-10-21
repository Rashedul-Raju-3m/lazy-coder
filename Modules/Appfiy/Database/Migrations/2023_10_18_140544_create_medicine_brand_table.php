<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicineBrandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('medicine_brand', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brand_id')->nullable();
            $table->string('generic_id')->nullable();
            $table->string('company_id')->nullable();
            $table->string('medicineForm')->nullable();
            $table->string('strength', 100)->nullable();
            $table->double('price')->nullable();
            $table->string('packSize', 100)->nullable();
            $table->integer('medicineGeneric_id')->nullable()->index('IDX_8DAFD12A010EB10');
            $table->integer('medicineCompany_id')->nullable()->index('IDX_8DAFD128F7A6EA0');
            $table->integer('globalOption_id')->nullable()->index('IDX_8DAFD12DC938C82');
            $table->string('dar', 100)->nullable();
            $table->string('useFor', 50)->nullable();
            $table->string('path')->nullable();
            $table->boolean('status')->nullable();
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
        Schema::dropIfExists('medicine_brand');
    }
}
