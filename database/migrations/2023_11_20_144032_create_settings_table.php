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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('business_name', 200)->nullable();
            $table->string('business_tin', 50)->nullable();
            $table->string('address', 100)->nullable();
            $table->string('contact_no', 20)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('url', 100)->nullable();
            $table->string('logo')->nullable();
            $table->string('auth_key', 255)->nullable();
            $table->string('daily_report_hour', 20)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
