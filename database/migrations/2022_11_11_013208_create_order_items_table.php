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
            $table->id("orderItemId");
            $table->foreignId("orderItemOrderId")
                    ->constrained("orders", "orderId")
                    ->onDelete("cascade");
            $table->foreignId("orderItemProductId")
                    ->constrained("products", "productId");
            $table->string("orderItemQuantity")->default("0");
            $table->decimal("orderItemTotalAmount")->default(0);
            $table->string("orderItemStatus")->default("Active");
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
