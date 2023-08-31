<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name');
            $table->string('patient_cpf');
            $table->string('patient_sus_card');
            $table->text('reason');
            $table->text('date');
            $table->text('time');
            $table->string('urgency');
            $table->integer('doctor_id');
            $table->integer('attending_professional_id');
            $table->timestamps();
            $table->unique(['date', 'time', 'doctor_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};
