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
        Schema::create('homes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->foreignId('portfolio_id')->constrained()->onDelete('cascade');
            $table->foreignId('city_id')->nullable();
            $table->foreignId('town_id')->nullable();
            $table->foreignId('district_id')->nullable();
            $table->foreignId('neighborhood_id')->nullable();
            $table->string('area_m2');
            $table->string('land_no');
            $table->string('parcel_no');
            $table->string('total_area');
            $table->string('room_count')->comment('1+0','1+1','2+1','3+1','4+1','4+2','5+2','6+2');
            $table->string('year');
            $table->string('usage_status')->comment('Boş','Mal Sahibi var','Kiracı Var');
            $table->string('building_status');
            $table->string('floor_count');
            $table->string('which_floor');
            $table->string('heating')->nullable()->comment('Kombi','Klima','Elektrikli');
            $table->string('entrance_gate_count')->default('1');
            $table->string('arrival_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
