<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transportations', function (Blueprint $table) {
            $table->id();
            $table->string('transporter')->nullable();
            $table->double('cost')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('paid')->default(false);
            $table->boolean('delivered')->default(false);
            $table->string('carrier_comment')->nullable();

            $table->string('seller_name');
            $table->string('lot_number');
            $table->string('account_number');
            $table->string('seller_phone');
            $table->string('seller_address');
            $table->date('pick_up_by');
            $table->string('seller_comment')->nullable();

            $table->foreignId('cargo_id')->constrained()->cascadeOnDelete();
            $table->string('warehouse');
            $table->date('purchased_date');
            $table->boolean('paid')->default(false);
            $table->boolean('ready')->default(false);
            $table->boolean('has_photos')->default(false);
            $table->boolean('key')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('transportations');
    }
}
