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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registrant_id')->constrained('event_registrants')->onDelete('cascade');
            $table->unsignedBigInteger('amount')->nullable();
            $table->string('proof_image')->nullable();
            $table->string('bank_beneficiary')->nullable();
            $table->string('bank_name')->nullable();
            $table->enum('status', ['pending', 'verification', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
