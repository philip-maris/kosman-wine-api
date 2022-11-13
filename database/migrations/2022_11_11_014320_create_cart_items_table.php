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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id("cartItemId");
            $table->foreignId("cartItemCartId")
                ->constrained("carts", "cartId")
                ->onDelete("cascade");
            $table->foreignId("cartItemProductId")
                    ->constrained("products", "productId")
                    ->onDelete("cascade");
            $table->string("cartItemQuantity")->default("0");
            $table->decimal("cartItemTotalAmount")->default(0);
            $table->string("cartItemStatus")->default("Active");
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
        Schema::dropIfExists('cart_items');
    }
};
