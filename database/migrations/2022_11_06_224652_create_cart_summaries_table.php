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
        Schema::create('cart_summaries', function (Blueprint $table) {
            $table->id("cartSummariesId");
            $table->string("cartSummariesVat")->nullable();
            $table->float("cartSummariesDeliveryFee")->nullable();
            $table->string("cartSummariesSubtotalAmount")->nullable();
            $table->string("cartSummariesTotalAmount")->nullable();
            $table->foreignId("cartSummariesCartId")
                    ->constrained("carts", "cartId")
                    ->onDelete('cascade');
            $table->foreignId("cartSummariesCartItemsId")
                    ->constrained("cart_items", "cartItemsId")
                    ->onDelete('cascade');
            $table->string("cartSummariesStatus")->default("Active");
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
        Schema::dropIfExists('cart_summaries');
    }
};
