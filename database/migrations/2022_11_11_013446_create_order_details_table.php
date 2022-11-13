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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id("orderDetailId");
            $table->string("orderDetailFirstName")->nullable();
            $table->string("orderDetailLastName")->nullable();
            $table->foreignId("orderDetailOrderId")
                ->constrained("orders", "orderId")
                ->onDelete("cascade");
            $table->string("orderDetailEmail")->nullable();
            $table->string("orderDetailPhone")->nullable();
            $table->string("orderDetailAddress")->nullable();
            $table->string("orderDetailState")->nullable();
            $table->string("orderDetailStatus")->default("Active");
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
        Schema::dropIfExists('order_details');
    }
};
