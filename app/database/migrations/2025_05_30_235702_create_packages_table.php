<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');                        // z. B. "Starter", "Pro", "Enterprise"
            $table->string('slug')->unique();              // z. B. "starter" – zum internen Mapping
            $table->unsignedInteger('storage_limit_mb');   // In MB
            $table->unsignedInteger('max_users')->default(1);
            $table->json('features')->nullable();          // z. B. ["visual_editor", "private_wiki"]
            $table->unsignedInteger('price_cents')->default(0); // Preis in Cent (monatlich)
            $table->boolean('is_active')->default(true);   // deaktivierbare Pakete
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
