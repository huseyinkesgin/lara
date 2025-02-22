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
        Schema::create('adverts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('portfolio_id')->constrained();
            $table->string('ad_websites')->comment('Burada Yapı','Sahibinden','HepsiEmlak','Zinagt','Arsaburada','Depofakrika');
            $table->string('ad_id');
            $table->string('ad_link');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adverts');
    }
};
