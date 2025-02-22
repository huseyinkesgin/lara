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
        Schema::create('bank_offices', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->foreignId('bank_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->foreignId('city_id')->nullable();
            $table->foreignId('town_id')->nullable();
            $table->foreignId('district_id')->nullable();
            $table->foreignId('neighborhood_id')->nullable();
            $table->string('address')->nullable();
            $table->string('authorized_name')->nullable();
            $table->string('authorized_gsm')->nullable();
            $table->string('authorized_phone_number')->nullable();
            $table->string('authorized_extension_number')->nullable();
            $table->string('authorized_email')->nullable();
            $table->string('status')->comment('Aktif','Kapandı','Taşındı');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_offices');
    }
};
