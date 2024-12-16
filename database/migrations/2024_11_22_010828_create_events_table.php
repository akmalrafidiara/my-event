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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('location');    
            $table->string('featured_image');
            $table->date('start_event_at');
            $table->date('end_event_at');
            $table->unsignedInteger('min_age')->default(0);
            $table->unsignedInteger('price');
            $table->unsignedInteger('quota');
            $table->foreignId('category_id')->constrained('event_categories')->onDelete('cascade');
            $table->enum('status', ['upcoming', 'open', 'ongoing', 'done'])->default('upcoming');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
