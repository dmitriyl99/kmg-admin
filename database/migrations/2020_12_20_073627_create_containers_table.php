<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('containers', function (Blueprint $table) {
            $table->id();
            $table->string('container_number');
            $table->string('booking_number')->nullable();
            $table->string('shipping_line')->nullable();
            $table->string('port');
            $table->string('destination');
            $table->integer('capacity');
            $table->boolean('paid')->default(false);
            $table->string('tracking_link')->nullable();
            $table->date('departure_date')->nullable();
            $table->date('arrival_date')->nullable();

            $table->foreignId('container_status_id')->constrained();
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
        Schema::dropIfExists('containers');
    }
}
