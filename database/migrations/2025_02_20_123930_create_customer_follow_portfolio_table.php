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
        Schema::create('customer_follow_portfolio', function (Blueprint $table) {
            $table->foreignId('customer_follow_id')->constrained()->onDelete('cascade');
            $table->foreignId('portfolio_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_follow_portfolio');
    }
};
