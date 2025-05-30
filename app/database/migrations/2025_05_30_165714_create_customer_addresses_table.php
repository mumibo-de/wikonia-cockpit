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
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();

            $table->string('company_name')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('street');
            $table->string('postbox')->nullable();
            $table->string('zip', 12);
            $table->string('city');
            $table->string('country', 2)->default('DE'); // ISO-3166-1 alpha-2 (z. B. DE, AT, FR)
            $table->string('vat_id')->nullable(); // USt-ID
            $table->string('invoice_email')->nullable(); // separate Mailadresse für Rechnungen

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_addresses');
    }
};
