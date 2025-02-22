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
        Schema::create('lands', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->foreignId('portfolio_id')->constrained()->onDelete('cascade');
            $table->foreignId('city_id')->constrained()->onDelete('cascade');
            $table->foreignId('town_id')->constrained()->onDelete('cascade');
            $table->foreignId('district_id')->constrained()->onDelete('cascade');
            $table->foreignId('neighborhood_id')->constrained()->onDelete('cascade');
            $table->string('land_no');
            $table->string('parcel_no');
            $table->string('zooning_status');
            $table->string('area_m2');
            $table->string('similar')->nullable();
            $table->string('height')->nullable();
            $table->string('arrival_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lands');
    }
};
