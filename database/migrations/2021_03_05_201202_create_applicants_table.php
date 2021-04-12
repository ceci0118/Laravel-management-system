<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->string('first');
            $table->string('last');
            $table->date('dob');
            $table->string('email')->unique();
            $table->unsignedBigInteger('applicant_type');
            $table->foreign('applicant_type')->references('id')->on('applicant_types');
            $table->string('applicant_id')->nullable();
            $table->integer('season_id')->default(1);
            $table->unsignedBigInteger('status');
            $table->foreign('status')->references('id')->on('status_types')->default(1);
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
        Schema::dropIfExists('applicants');
    }
}
