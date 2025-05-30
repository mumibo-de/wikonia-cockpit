<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }

    /**
     * Erzeugen des Kunden-Moedells (Grunddaten)
     */
    public function up(): void
    {
    Schema::create('customers', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('slug')->unique();
        $table->string('email')->nullable();
        $table->string('status')->default('pending'); // pending, active, trial, suspended, canceled, deleted, archived, expired, inactive
        $table->string('ext_id')->nullable();
        $table->string('monkeyoffice_id')->nullable();
        $table->boolean('newsletter_opt_in')->default(false);

        // AGB-Zustimmung
        $table->string('agb_version')->nullable();
        $table->longText('agb_text')->nullable();
        $table->timestamp('agb_accepted_at')->nullable();

        // Datenschutz-Zustimmung
        $table->string('privacy_version')->nullable();
        $table->longText('privacy_text')->nullable();
        $table->timestamp('privacy_accepted_at')->nullable();

        $table->json('settings')->nullable();

        $table->timestamps(); // created_at & updated_at
    });
    }

};
