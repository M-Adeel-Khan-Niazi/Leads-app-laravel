<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadMeasureTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_measure_types', function (Blueprint $table) {
            $table->id();
            $table->string('m2')->nullable();
            $table->integer('cost')->default(0);
            $table->integer('material_cost')->default(0);
            $table->date('start_date')->nullable();
            $table->date('completion_date')->nullable();
            $table->boolean('is_warranty_applied')->default(false);
            $table->integer('ibg_cost')->default(0);
            $table->integer('lead_id');
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
        Schema::dropIfExists('lead_measure_types');
    }
}
