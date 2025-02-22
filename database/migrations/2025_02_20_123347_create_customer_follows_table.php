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
        Schema::create('customer_follows', function (Blueprint $table) {
            $table->id();
            $table->string('service_type')->comment('Telefon','Sunum','Yer Gösterme','Kontrat Hazırlama','Diger');
            $table->string('service_date');
            $table->foreignId('customer_id')->constrained();
            $table->foreignId('personnel_id')->constrained();
            $table->string('note')->nullable();
            $table->string('status')->comment('Devam ediyor','Başka Bakıyor','Başka Emlakçı');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_follows');
    }
};
