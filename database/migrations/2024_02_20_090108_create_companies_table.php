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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('tax_name')->nullable();
            $table->string('tax_office')->nullable();
            $table->string('tax_number')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('mersis_number')->nullable();
            $table->string('kep_address')->nullable();
            $table->string('website')->nullable();
            $table->foreignId('city_id')->nullable();
            $table->foreignId('town_id')->nullable();
            $table->foreignId('district_id')->nullable();
            $table->foreignId('neighborhood_id')->nullable();
            $table->string('address')->nullable();
            $table->string('description')->nullable();
            $table->string('status')->comment('Aktif','Kapandı','Taşındı');
            //banka bilgileri many to many olarak başka tabloda olacak.multiple olması için
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
