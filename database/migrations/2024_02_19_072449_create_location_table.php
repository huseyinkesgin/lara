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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name')->unique();
            $table->boolean('is_active')->default(1);
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('towns', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->foreignId('city_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->boolean('is_active')->default(1);
            $table->string('description')->nullable();
 
            $table->timestamps();
        });

        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->foreignId('town_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->boolean('is_active')->default(1);
            $table->string('description')->nullable();
           
            $table->timestamps();
        });

        Schema::create('neighborhoods', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->foreignId('district_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->boolean('is_active')->default(1);
            $table->string('description')->nullable();
            $table->string('postal_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location');
    }
};
