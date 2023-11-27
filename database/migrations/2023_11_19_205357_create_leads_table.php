<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('address_line_one')->nullable();
            $table->string('house_number')->nullable();
            $table->string('street')->nullable();
            $table->string('town')->nullable();
            $table->string('postal_code')->nullable();
            //
            $table->string('resident_first_name')->nullable();
            $table->string('resident_mid_name')->nullable();
            $table->string('resident_sur_name')->nullable();
            $table->date('resident_dob')->nullable();
            $table->string('resident_contact')->nullable();
            $table->string('resident_email')->nullable();
            //
            $table->enum('type', ['owner', 'rented'])->default('owner');
            $table->string('owner_name')->nullable();
            $table->string('owner_email')->nullable();
            $table->string('owner_contact')->nullable();
            //
            $table->string('benefit_type')->nullable();
            $table->boolean('is_benefit_recipient')->default(false);
            // No per
            $table->string('benefit_first_name')->nullable();
            $table->string('benefit_mid_name')->nullable();
            $table->string('benefit_sur_name')->nullable();
            $table->date('benefit_dob')->nullable();
            $table->string('relationship')->nullable();
            //
            $table->boolean('is_prev_epc')->default(false);
            $table->integer('epc_rating')->nullable();
            $table->date('epc_date')->nullable();
            //
            $table->boolean('is_property_check')->default(false);
            $table->string('comment')->nullable();

            $table->string('gas_safe_results')->nullable();
            $table->string('property_type')->nullable();
            $table->string('main_wall_type')->nullable();
            $table->string('extension_wall_type')->nullable();
            $table->boolean('is_data_sent')->default(false);
            $table->boolean('is_benefit_proof_sent')->default(false);
            $table->boolean('is_address_proof_sent')->default(false);
            //
            $table->string('source')->nullable();
            $table->enum('status', ['draft', 'pending', 'stop', 'in-progress', 'completed'])->default('draft');
            $table->integer('agent_id')->nullable();
            $table->string('notes')->nullable();
            $table->integer('created_by');
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
        Schema::dropIfExists('leads');
    }
}
