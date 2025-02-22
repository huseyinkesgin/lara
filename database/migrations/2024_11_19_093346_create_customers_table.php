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
            $table->string('customer_type')->comment('Bireysel', 'Kurumsal');
            $table->string('customer_source')->comment(
                'İlan Sitelerinden',
                'Ofis Ziyareti',
                'Referans',
                'Websitesinden',
                'Sosyal Medyadan',
                'Emlakçı',
                'Diğer');
          
            $table->string('customer_group')->comment('Müşteri','Mal Sahibi','Emlakçı','Referans');
            $table->string('name');
            $table->string('tc_no')->nullable();
            $table->string('phone')->nullable();
            $table->string('second_phone')->nullable();
            $table->string('email')->nullable();
            $table->foreignId('city_id')->nullable();
            $table->foreignId('town_id')->nullable();
            $table->foreignId('district_id')->nullable();
            $table->foreignId('neighborhood_id')->nullable();
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
