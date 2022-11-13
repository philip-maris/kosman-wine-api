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
        Schema::create('products', function (Blueprint $table) {
            $table->id("productId");
            $table->string("productName")->nullable();
            $table->decimal("productSellingPrice")->default(0);
            $table->decimal("productOfferPrice")->default(0);
            $table->string("productImage")->nullable();
            $table->longText("productDescription")->nullable();
            $table->integer("productDiscount")->default(0);

            $table->foreignId("productBrandId")
                ->constrained('brands', 'brandId')
                ->onDelete('set null');

            $table->foreignId("productCategoryId")
                ->constrained('categories', 'categoryId')
                ->onDelete('set null');
            $table->integer("productQuantity")->default(0);
            $table->string("productSlug")->nullable();
            $table->string("productStatus")->default("Active");
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
        Schema::dropIfExists('products');
    }
};
