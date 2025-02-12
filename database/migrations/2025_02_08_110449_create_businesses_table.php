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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->foreignId('customer_id')->constrained('customers');
            $table->string('area');
            $table->foreignId('city_id')->constrained('cities');
            $table->foreignId('district_id')->constrained('districts');
            $table->foreignId('neighbourhood_id')->constrained('neighbourhoods');
            $table->integer('land');
            $table->integer('parcel');
            $table->string('zooning_status');
            $table->string('indoor_area')->nullable();
            $table->string('open_area')->nullable();
            $table->string('business_area')->nullable();
            $table->string('office_area')->nullable();
            $table->string('height')->nullable();
            $table->string('elektric_capacity')->nullable();
            $table->integer('year')->nullable();
            $table->string('building_condition')->nullable();
            $table->string('usage_status')->nullable();
            $table->string('heating_type')->nulable();
            $table->string('entrance_count')->nulable();
            $table->string('floor_count')->nulable();
            $table->boolean('is_crane')->default(false);
            $table->string('crane_notes')->nullable();
            $table->text('notes')->nullable();
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
