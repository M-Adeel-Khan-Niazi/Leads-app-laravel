<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadDataMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_data_matches', function (Blueprint $table) {
            $table->id();
            $table->integer('lead_id');
            $table->string('land_reg_check')->nullable();
            $table->boolean('is_land_reg_matched')->nullable();
            $table->boolean('is_match_sent')->nullable();
            $table->string('data_match_result')->nullable();
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('lead_data_matches');
    }
}
