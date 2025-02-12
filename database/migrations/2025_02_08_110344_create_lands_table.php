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
            $table->string('enter_date')->nullable();
            $table->foreignId('customer_id')->constrained('customers');
            $table->string('area');
            $table->foreignId('city_id')->constrained('cities');
            $table->foreignId('district_id')->constrained('districts');
            $table->foreignId('neighbourhood_id')->constrained('neighbourhoods');
            $table->string('land');
            $table->string('parcel');
            $table->string('zooning_status');
            $table->string('similar')->nullable();
            $table->string('size')->nullable();
            $table->foreignId('personnel_id')->constrained('personnels');
            $table->string('description')->nullable();
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
