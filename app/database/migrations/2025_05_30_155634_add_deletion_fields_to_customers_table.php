<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->enum('deletion_state', ['none', 'requested', 'soft'])->default('none')->after('status');
            $table->timestamp('deletion_date')->nullable()->after('deletion_state');
        });
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn(['deletion_state', 'deletion_date']);
        });
    }
};

