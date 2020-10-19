<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donation_donor_id')->nullable()->constrained();
            $table->string('ref', 100)->nullable();
            $table->string('type', 100)->nullable();
            $table->string('platform', 100)->nullable();
            $table->json('txdata')->nullable();
            $table->integer('amount')->nullable();
            $table->boolean('confirmed')->default(false);
            $table->boolean('part_payment')->default(false);
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
        Schema::dropIfExists('payments');
    }
}
