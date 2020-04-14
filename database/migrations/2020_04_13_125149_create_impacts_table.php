<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImpactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('impacts', function (Blueprint $table) {
            $table->id();
            $table->string('currentlyInfected',100);

            $table->string('infectionsByRequestedTime', 100);
            $table->string('severeCasesByRequestedTime', 100);
            $table->string('hospitalBedsByRequestedTime', 100);
            $table->string('casesForICUByRequestedTime', 100);
            $table->string('casesForVentilatorsByRequestedTime', 100);
            $table->string('dollarsInFlight', 100);
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
        Schema::dropIfExists('impacts');
    }
}
