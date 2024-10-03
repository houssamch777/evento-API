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
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->enum('experience', ['Beginner', 'Intermediate', 'Expert']); // Skill experience level
            $table->boolean('offer_as_service')->default(false); // Whether the skill is provided as a service
            $table->string('portfolio_url')->nullable(); // URL for the portfolio
            $table->decimal('cost', 8, 2)->nullable(); // Cost amount (either per hour or per task)
            $table->enum('cost_type', ['per_hour', 'per_task'])->default('per_hour'); // Whether the cost is per hour or per task
            $table->json('availability')->nullable(); // Availability (days and time)
            $table->decimal('skill_rating', 2, 1)->default(2.5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};
