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
        Schema::create('customers', function (Blueprint $table) {
            $table->id("customerId");
            $table->string('customerFirstName')->nullable();
            $table->string('customerLastName')->nullable();
            $table->string('customerEmail')->unique()->nullable();
            $table->string('customerPhoneNo')->nullable();
            $table->string('customerAddress')->nullable();
            $table->string('customerState')->nullable();
            $table->string('customerPassword')->nullable();
            $table->string('customerOtp')->nullable();
            $table->timestamp('customerOtpExpired')->nullable();
            $table->string('customerStatus')->default("Pending");
            $table->integer('isAdmin')->default(0);
            $table->integer('isSuperAdmin')->default(0);
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
        Schema::dropIfExists('customers');
    }
};
