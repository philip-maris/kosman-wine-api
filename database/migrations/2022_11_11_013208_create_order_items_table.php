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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id("orderItemsId");
            $table->foreignId("orderItemsOrderId")
                    ->constrained("orders", "orderId")
                    ->onDelete("cascade");
            $table->foreignId("orderItemsProductId")
                    ->constrained("products", "productId");
            $table->string("orderItemsQuantity")->default("0");
            $table->decimal("orderItemsTotalAmount")->default(0);
            $table->string("orderItemsStatus")->default("Active");
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
        Schema::dropIfExists('order_items');
    }
};
