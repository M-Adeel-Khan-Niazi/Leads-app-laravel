<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadMeasureCategoryTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_measure_category_types', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->integer('cost')->default(0);
            $table->enum('type', ['material', 'installer']);
            $table->integer('lead_id');
            $table->integer('measure_category_id');
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
        Schema::dropIfExists('lead_measure_category_types');
    }
}
