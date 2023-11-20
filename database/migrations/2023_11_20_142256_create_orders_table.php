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
            $table->id('order_id');
            $table->integer('invoice_no')->nullable();
            $table->string('customer_name', 50)->nullable();
            $table->string('total_amount', 20)->nullable();
            $table->string('discount_percent', 20)->nullable();
            $table->string('total_discount_amount', 20)->nullable();
            $table->string('payment_type', 20)->nullable();
            $table->string('payment_amount', 20)->nullable('0');
            $table->string('payment_change', 20)->nullable();
            $table->string('service_type', 20)->nullable();
            $table->string('order_status', 20)->nullable();
            $table->string('payment_status', 20)->nullable();
            $table->longText('product_name')->nullable();
            $table->longText('quantity')->nullable();
            $table->longText('unit_price')->nullable();
            $table->longText('note')->nullable();
            $table->boolean('order_seen')->nullable();
            $table->integer('update_count')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
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
