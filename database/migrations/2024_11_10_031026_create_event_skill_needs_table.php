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
        Schema::create('event_skill_needs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('skill_name_id');
            $table->integer('quantity')->default(1); // Quantity of the skill needed
            $table->timestamps();

            // Foreign keys
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('skill_name_id')->references('id')->on('skill_names')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_skill_needs');
    }
};
