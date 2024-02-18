<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadRetrofitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_retrofits', function (Blueprint $table) {
            $table->id();
            $table->integer('lead_id');
            $table->string('ra_name')->nullable();
            $table->boolean('is_rfa_complete')->nullable();
            $table->boolean('is_rfa_lodged')->nullable();
            $table->date('rfa_booked_date')->nullable();
            $table->time('rfa_booked_time')->nullable();
            $table->string('pre_epr_result')->nullable();
            $table->string('post_epr_result')->nullable();
            $table->string('floor_area')->nullable();
            $table->boolean('is_floor_plan_created')->nullable();
            $table->string('rc_name')->nullable();
            $table->string('wall_type')->nullable();
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
        Schema::dropIfExists('lead_retrofits');
    }
}
