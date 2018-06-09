<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string("first_name");
            $table->string("last_name");
            $table->date("date_of_birth")->nullable();
            $table->smallInteger("gender")->comment("1 = Male , 2 = Female , 3 = Other")->nullable();
            $table->smallInteger("marital_status")->comment("1=single, 2=Married, 3=Divorced, 4=Other")->nullable();
            $table->boolean("screened_before")->comment("0 = No , 1 = Yes")->nullable();
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
        Schema::dropIfExists('patients');
    }
}
