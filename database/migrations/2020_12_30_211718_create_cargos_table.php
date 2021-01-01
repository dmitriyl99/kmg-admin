<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargos', function (Blueprint $table) {
            $table->id();
            $table->string('owner');
            $table->string('name');
            $table->string('vin')->index();
            $table->string('port')->nullable();
            $table->date('received_at')->nullable();
            $table->string('destination_country');

            $table->string('transportation_from')->nullable();
            $table->string('transportation_address')->nullable();
            $table->double('transportation_price')->nullable();

            $table->date('date_received')->nullable();
            $table->string('key')->nullable();

            $table->double('total_due');

            $table->string('postal_service')->nullable();
            $table->string('tracking_number')->nullable();

            $table->foreignId('container_id')->nullable()->constrained()->nullOnDelete();
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
        Schema::dropIfExists('cargos');
    }
}
