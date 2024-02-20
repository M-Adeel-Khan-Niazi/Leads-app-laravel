<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadMeasureCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_measure_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('lead_id');
            $table->integer('installer_id');
            $table->string('m2')->nullable();
            $table->string('measure_status')->nullable();
            $table->string('category')->nullable();
            $table->date('start_date')->nullable();
            $table->date('completion_date')->nullable();
            $table->boolean('is_customer_informed')->default(false);
            $table->boolean('is_pibi')->nullable();
            $table->boolean('is_design')->nullable();
            $table->boolean('is_tech_survey')->nullable();
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
