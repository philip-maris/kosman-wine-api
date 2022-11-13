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
        Schema::create('orders', function (Blueprint $table) {
            $table->id("orderId");
            $table->foreignId("orderCustomerId")
                    ->constrained('customers', 'customerId');
            $table->foreignId("orderDeliveryId")
                    ->constrained('deliveries', 'deliveryId');
            $table->decimal("orderTotalAmount")->default(0);
            $table->string("orderReference")->nullable();
            $table->string("orderPaymentMethod")->nullable();
            $table->decimal("orderSubTotalAmount")->default(0);
            $table->string("orderStatus")->default("Active");
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
        Schema::dropIfExists('orders');
    }
};
