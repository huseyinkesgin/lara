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
        Schema::create('personnels', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name')->nullable();
            $table->string('tc_no')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('phone')->nullable()->unique();
            $table->foreignId('city_id');
            $table->foreignId('town_id');
            $table->foreignId('district_id');
            $table->foreignId('neighborhood_id');
            $table->string('address')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->comment('Çalışıyor, İşten Ayrıldı, Askeri Görevde');
            $table->string('description')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnels');
    }
};
