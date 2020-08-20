<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->foreign('patient_id')->references('id')->on('users');
            $table->unsignedBigInteger('donor_id')->nullable();
            $table->foreign('donor_id')->references('id')->on('users');
            $table->foreignId('service_id')->nullable()->constrained();

            $table->text('description');
            $table->enum('status', ['initiated', 'incomplete', 'assigned', 'completed', 'done', 'pending'])->default('incomplete');
            $table->string('hospital_name', 255)->nullable();
            $table->string('hospital_contact', 255)->nullable();
            $table->string('hospital_location', 255)->nullable();
            $table->string('doctor_name', 255)->nullable();
            $table->string('doctor_contact', 255)->nullable();

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
        Schema::dropIfExists('service_requests');
    }
}
