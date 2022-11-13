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
            $table->id("cartSummaryId");
            $table->string("cartSummaryVat")->nullable();
            $table->float("cartSummaryDeliveryFee")->nullable();
            $table->string("cartSummarySubtotalAmount")->nullable();
            $table->string("cartSummaryTotalAmount")->nullable();
            $table->foreignId("cartSummaryCartId")
                    ->constrained("carts", "cartId")
                    ->onDelete('cascade');
            $table->foreignId("cartSummaryCartItemId")
                    ->constrained("cart_items", "cartItemId")
                    ->onDelete('cascade');
            $table->string("cartSummaryStatus")->default("Active");
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
