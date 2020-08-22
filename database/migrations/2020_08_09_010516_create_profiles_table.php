<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('other_names', 100)->nullable();
            $table->text('avatar')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->string('blood_group', 20);
            $table->text('medical_details')->nullable();
            $table->string('home_address', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('mobile_money_name', 100);
            $table->string('mobile_money_number', 15);
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
        Schema::dropIfExists('profiles');
    }
}
