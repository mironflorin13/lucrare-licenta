<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDentistAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dentist_appointments', function (Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('service_name');
            $table->unsignedBigInteger('dentist_id');
            $table->String('created_by');
            $table->unsignedBigInteger('created_by_id');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->time('duration');
            $table->tinyInteger('review');
            $table->String('patient_name')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
            
            $table->index('dentist_id');
            $table->index('created_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dentist_appointments');
    }
}
