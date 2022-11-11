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
                    ->constrained('customers', 'customerId')->onDelete('cascade');
            $table->foreignId("orderDeliveryId")
                    ->constrained('deliveries', 'deliveryId')->onDelete('cascade');
            $table->foreignId("orderProductId")
                    ->constrained('products', 'productId');
            $table->string("orderDeliveryAddress")->nullable();
            $table->string("orderEmail")->nullable();
            $table->string("orderFirstName")->nullable();
            $table->string("orderLastName")->nullable();
            $table->string("orderPhone")->nullable();
            $table->string("orderState")->nullable();
            $table->string("orderProducts")->nullable();
            $table->string("orderTotalPrice")->nullable();
            $table->string("orderSubTotalPrice")->nullable();
            $table->string("orderStatus")->default("ACTIVE");
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
