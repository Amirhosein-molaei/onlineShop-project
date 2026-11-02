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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('address_id')->constrained('addresses')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('payment_id')->constrained('payments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('delivery_id')->constrained('deliveries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('copan_id')->constrained('copans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('cart_id')->constrained('carts')->onDelete('cascade')->onUpdate('cascade');
            $table->text('address_object');
            $table->text('payment_object');
            $table->text('delivery_object');
            $table->tinyInteger('payment_type')->comment('0 => online, 1 => offline');
            $table->tinyInteger('payment_status')->comment('0 => pending, 1 => ok, 2 => failed');
            $table->unsignedBigInteger('delivery_amount')->default(0);
            $table->tinyInteger('delivery_status')->comment('0 => pending, 1 => sent, 2 => refund');
            $table->timestamp('delivery_date')->nullable();
            $table->unsignedBigInteger('order_final_amount');
            $table->unsignedBigInteger('order_discount_amount');
            $table->unsignedBigInteger('order_total_discount');
            $table->tinyInteger('order_status')->comment('0 => pending, 1 => in progress, 2 => ok, 3=> failed, 4 => refund');
            $table->timestamps();
            $table->softDeletes();
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
