<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_id')->constrained();
            $table->foreignId('mail_template_id')->constrained();
            $table->string('subject');
            $table->string('from');
            $table->string('to'); // could be applicant or guardian
            $table->string('cc')->nullable();
            $table->string('content');
            $table->unsignedBigInteger('mail_status');
            $table->foreign('mail_status')->references('id')->on('mail_status_types')->default(1); # 1 - Sent, 2 - Opened, 3 - Bounced
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
        Schema::dropIfExists('mail_messages');
    }
}
