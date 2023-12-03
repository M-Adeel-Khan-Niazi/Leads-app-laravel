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
            $table->boolean('is_flexible')->default(false);
            $table->string('comment')->nullable();
            $table->boolean('is_match_sent')->default(false);
            $table->string('regs_check_result')->nullable();
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
            $table->boolean('is_boiler_replacement')->default(false);
            $table->boolean('is_external_wall_insulation')->default(false);
            $table->boolean('is_first_time_central_heating')->default(false);
            $table->boolean('is_internal_wall_insulation')->default(false);
            $table->boolean('is_cavity_wall_insulation')->default(false);
            $table->boolean('is_under_floor_insulation')->default(false);
            $table->boolean('is_loft_insulation')->default(false);
            $table->boolean('is_heating_controls')->default(false);
            $table->boolean('is_solar_pv')->default(false);
            $table->boolean('is_air_source')->default(false);
            $table->boolean('is_storage_heater')->default(false);
            $table->boolean('is_rir')->default(false);
            $table->integer('trickle_vents')->default(0);
            $table->integer('air_brick')->default(0);
            $table->integer('fans')->default(0);
            $table->integer('minor_work_cert')->default(0);
            $table->integer('roof_vents')->default(0);
            $table->integer('door_undercut')->default(0);
            $table->integer('other_ventilation')->default(0);
            $table->integer('retrofit_coordinator_cost')->default(0);
            $table->integer('retrofit_assessor_cost')->default(0);
            $table->integer('gas_safe_reg')->default(0);
            $table->date('handover_on')->nullable();
            $table->boolean('is_completed_submission')->default(false);
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
