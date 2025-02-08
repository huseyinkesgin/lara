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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('customer_type');
            $table->foreignId('company_id')->nullable();
            $table->string('customer_group');
            $table->string('name');
            $table->string('tc_no')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->foreignId('city_id')->constrained('cities')->nullable();
            $table->foreignId('district_id')->constrained('districts')->nullable();
            $table->foreignId('neighbourhood_id')->constrained('neighbourhoods')->nullable();
            $table->string('address')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
