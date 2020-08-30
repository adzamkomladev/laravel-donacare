<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->foreign('patient_id')->references('id')->on('users');
            $table->unsignedBigInteger('donor_id')->nullable();
            $table->foreign('donor_id')->references('id')->on('users');
            $table->foreignId('service_id')->nullable()->constrained();
            $table->foreignId('location_id')->nullable()->constrained();

            $table->enum('status', ['initiated', 'incomplete', 'assigned', 'completed', 'done', 'pending'])->default('incomplete');
            $table->enum('type', ['blood', 'organ', 'funds']);
            $table->text('value');
            $table->text('description')->nullable();
            $table->date('date_needed');
            $table->double('cost', 10, 2)->nullable();
            $table->enum('payment_status', ['free', 'charged']);
            $table->string('payment_method', 100)->nullable();
            $table->string('hospital_name', 255);
            $table->string('hospital_location', 255);
            $table->boolean('share_location')->nullable()->default(false);
            $table->string('doctor_name', 255);
            $table->string('doctor_phone', 15);
            $table->string('doctor_staff_id', 40);

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
        Schema::dropIfExists('donations');
    }
}
