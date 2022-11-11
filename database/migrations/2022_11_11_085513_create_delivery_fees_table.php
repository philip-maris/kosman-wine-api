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
        Schema::create('delivery_fees', function (Blueprint $table) {
            $table->id("deliveryFeeId");
            $table->string("deliveryFeeDeliveryCity")->nullable();
            $table->string("deliveryFeeDeliveryTown")->nullable();
            $table->foreignId("deliveryFeeDeliveryId")
                    ->constrained("deliveries", "deliveryId")
                    ->onDelete('cascade');
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
        Schema::dropIfExists('delivery_fees');
    }
};
