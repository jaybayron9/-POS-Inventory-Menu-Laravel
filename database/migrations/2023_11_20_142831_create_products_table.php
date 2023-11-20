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
        Schema::create('products', function (Blueprint $table) { 
            $table->id('product_id');
            $table->string('product_name', 50);
            $table->integer('price')->default(0);
            $table->enum('status', ['available', 'unavailable'])->default('available');
            $table->longText('picture')->nullable();
            $table->longText('note')->nullable();
            $table->integer('original_quantity')->default(0);
            $table->integer('current_quantity')->default(0);
            $table->integer('reorder_level')->default(0);
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->decimal('sale_amount', 10, 2)->default(0);
            $table->string('category', 50)->nullable(); 
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
