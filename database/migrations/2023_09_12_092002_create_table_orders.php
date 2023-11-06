<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedDecimal("grand_total",14,2);
            $table->smallInteger("status")->default(0);
            $table->unsignedBigInteger("user_id")->nullable();
            $table->string("email")->nullable();
            $table->string("full_name");
            $table->string("tel",20);
            $table->string("address");
            $table->string("shipping_method");
            $table->string("payment_method");
            $table->boolean("is_paid")->default(false);
            $table->timestamps();
            $table->foreign("user_id")->references("id")->on("users");
            $table->decimal('revenue', 10, 2)->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
