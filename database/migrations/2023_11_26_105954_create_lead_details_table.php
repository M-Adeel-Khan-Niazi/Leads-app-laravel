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
            $table->decimal('total_material', 5, 2)->default(0);
            $table->decimal('total_installer', 5, 2)->default(0);
            $table->decimal('sub_total', 5, 2)->default(0);
            $table->decimal('total_cost', 5, 2)->default(0);
            $table->string('share_type')->default('percentage');
            $table->decimal('introducer_share', 5, 2)->default(0);
            $table->decimal('introducer_fee', 5, 2)->default(0);
            $table->decimal('gross_profit', 5, 2)->default(0);
            $table->decimal('net_profit', 5, 2)->default(0);
            $table->decimal('abs_score', 5, 2)->default(0);
            $table->decimal('rate', 5, 2)->default(0);
            $table->decimal('funding', 5, 2)->default(0);
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
            $table->decimal('trickle_vents', 5, 2)->default(0);
            $table->decimal('air_brick', 5, 2)->default(0);
            $table->decimal('fans', 5, 2)->default(0);
            $table->decimal('minor_work_cert', 5, 2)->default(0);
            $table->decimal('roof_vents', 5, 2)->default(0);
            $table->decimal('door_undercut', 5, 2)->default(0);
            $table->decimal('other_ventilation', 5, 2)->default(0);
            $table->decimal('retrofit_coordinator_cost', 5, 2)->default(0);
            $table->decimal('retrofit_assessor_cost', 5, 2)->default(0);
            $table->decimal('gas_safe_reg', 5, 2)->default(0);
            $table->decimal('ibg_cost', 5, 2)->default(0);
            $table->decimal('tech_survey', 5, 2)->default(0);
            $table->decimal('retrofit_design_cost', 5, 2)->default(0);
            $table->decimal('land_reg_cost', 5, 2)->default(0);
            $table->decimal('trustmark_cost', 5, 2)->default(0);
            $table->decimal('building_regs_fee', 5, 2)->default(0);
            $table->decimal('data_match_cost', 5, 2)->default(0);
            $table->decimal('waste_manage', 5, 2)->default(0);
            $table->decimal('plumbing_cost', 5, 2)->default(0);
            $table->decimal('joinery_cost', 5, 2)->default(0);
            $table->decimal('travel_cost', 5, 2)->default(0);
            $table->decimal('food_cost', 5, 2)->default(0);
            $table->date('handover_on')->nullable();
            $table->boolean('is_handover_emailed')->default(0);
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
