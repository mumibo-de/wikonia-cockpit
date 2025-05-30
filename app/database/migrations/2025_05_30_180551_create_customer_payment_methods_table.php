<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('customer_payment_methods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->string('method');
            $table->json('data')->nullable();
            $table->boolean('default')->default(false);
            $table->timestamp('last_used_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_payment_methods');
    }
};
// This migration creates a new table for customer payment methods, allowing for multiple payment methods per customer.
// It includes fields for the payment method type, associated data, and flags for default and last used status.
// The `customer_id` field is a foreign key that links to the `customers` table, ensuring referential integrity.
