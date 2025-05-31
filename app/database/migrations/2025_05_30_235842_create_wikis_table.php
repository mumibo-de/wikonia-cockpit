<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wikis', function (Blueprint $table) {
            $table->id();

            // Beziehung zum Kunden
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');

            // Grunddaten des Wikis
            $table->string('name');                 // z. B. "Musik-Wiki"
            $table->string('slug')->unique();       // z. B. "musikwiki" → subdomain.wikonia.net
            $table->string('domain')->nullable();   // eigene Domain falls gebucht

            // Aktueller Status der Instanz
            $table->enum('status', [
                'provisioning',
                'active',
                'paused',
                'archived',
                'deleted'
            ])->default('provisioning');

            // Speicherlimit in MB
            $table->unsignedInteger('storage_limit_mb')->default(500);

            // Gebuchtes Paket
            $table->foreignId('package_id')->constrained()->onDelete('restrict');

            // Flexible JSON-Felder für Zusatzfunktionen
            $table->json('features')->nullable();  // z. B. aktivierte Erweiterungen
            $table->json('flags')->nullable();     // z. B. "sponsored", "testbetrieb"

            // Timestamps
            $table->timestamps(); // created_at + updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wikis');
    }
};
