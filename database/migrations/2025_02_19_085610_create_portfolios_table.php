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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('price');
            $table->string('serial_no')->unique()->nullable();
            $table->string('portfolio_no')->unique();
            $table->foreignId('portfolio_category_id')->constrained()->onDelete('cascade');
            $table->foreignId('portfolio_status_id')->constrained()->onDelete('cascade');
            $table->foreignId('portfolio_type_id')->constrained()->onDelete('cascade');
            $table->string('status')->comment('Aktif','İptal','Başkası Takip Ediyor')->nullable();
            $table->string('note')->nullable();
            $table->foreignId('personnel_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->boolean('is_eids')->default(false);
            $table->boolean('is_confirmed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
