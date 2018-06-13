<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHospitalParameterScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospital_parameter_scores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hospital_id');
            $table->integer('time_waiting');
            $table->integer('cost_of_service');
            $table->integer('number_of_treatment_methods');
            $table->integer('user_fee');
            $table->integer('trained_manpower');
            $table->integer('screening_tools_available');
            $table->integer('screening_tools_in_use');
            $table->integer('testing_equipment_available');
            $table->integer('testing_equipment_in_use');
            $table->integer('treatment_equipment_available');
            $table->integer('treatment_equipment_in_use');
            $table->integer('counselling_services');
            $table->integer('patient_follow_up');
            $table->string('createdby');
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
        Schema::dropIfExists('hospital_parameter_scores');
    }
}
