<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_details', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_regs_check')->default(false);
            $table->boolean('is_flexible')->default(false);
            $table->string('comment')->nullable();
            $table->boolean('is_match_sent')->default(false);
            $table->string('ra_name')->nullable();
            $table->date('rfa_booked_date')->nullable();
            $table->time('rfa_booked_time')->nullable();
            $table->boolean('is_rfa_complete')->default(false);
            $table->string('pre_epr_result')->nullable();
            $table->string('post_epr_result')->nullable();
            $table->string('floor_area')->nullable();
            $table->integer('abs_score')->default(0);
            $table->integer('rate')->default(0);
            $table->integer('funding')->default(0);
            $table->string('rc_name')->nullable();
            $table->string('wall_type')->nullable();
            $table->integer('measure_install')->nullable();
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
        Schema::dropIfExists('lead_details');
    }
}
