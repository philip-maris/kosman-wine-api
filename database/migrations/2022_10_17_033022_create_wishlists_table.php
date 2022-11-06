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
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id("wishlistId");
            $table->foreignId("wishlistCustomerId")
                ->constrained('customers', 'customerId')->onDelete('cascade');
            $table->foreignId("wishlistProductId")
                ->constrained('products', 'productId')->onDelete('cascade');
            $table->string("wishlistStatus")->default("ACTIVE");
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
        Schema::dropIfExists('wishlists');
    }
};
