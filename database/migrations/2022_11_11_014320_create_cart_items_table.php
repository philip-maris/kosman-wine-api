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
            $table->id("cartItemsId");
            $table->foreignId("cartItemsCartId")
                ->constrained("carts", "cartId")
                ->onDelete("cascade");
            $table->foreignId("cartItemsProductId")
                    ->constrained("products", "productId")
                    ->onDelete("cascade");
            $table->string("cartItemsQuantity")->default("0");
            $table->decimal("cartItemsTotalAmount")->default(0);
            $table->string("cartItemsStatus")->default("Active");
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
