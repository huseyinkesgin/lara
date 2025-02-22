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
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->foreignId('bank_office_id')->constrained()->onDelete('cascade');
            $table->string('name');// Hesap Adı
            $table->string('account_type')->comment('Vadesiz','Vadeli','Birikim','Kredi','Yatırım','Esnek','Doviz','Altın','Diğer');
            $table->string('currency')->default('TRY')->comment('TRY','USD','EUR','GBP','CHF');
            $table->string('branch_code')->nullable();
            $table->string('account_number')->unique();
            $table->string('iban')->unique(); 
            $table->string('status')->comment('Aktif','Kapandı');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_accounts');
    }
};
