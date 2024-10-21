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
        // Create event_categories table
        Schema::create('event_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Create event_domains table
        Schema::create('event_domains', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Create events table
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->unsignedBigInteger('organizer_id');
            $table->boolean('fee')->default(false); // Boolean to indicate if fee is required
            $table->boolean('privacy')->default(false);
            $table->enum('type', ['online', 'in-person']);
            $table->boolean('certificate')->default(false);
            $table->enum('status', ['Scheduled', 'Completed', 'Cancelled', 'Ongoing'])->default('Scheduled');
            $table->timestamps();

            // Foreign key to users (organizer)
            $table->foreign('organizer_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Create event_fees table for specific fee details
        Schema::create('event_fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->string('type'); // e.g., "General Admission," "VIP Access"
            $table->decimal('amount', 8, 2); // Specific fee amount for the type
            $table->timestamps();
        });

        // Create pivot table for event_categories and events (event_category)
        Schema::create('event_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('event_categories')->onDelete('cascade');
            $table->timestamps();

            $table->index(['event_id', 'category_id']); // Adding indexes for faster querying
        });

        // Create pivot table for event_domains and events (event_domain)
        Schema::create('event_domain', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->foreignId('domain_id')->constrained('event_domains')->onDelete('cascade');
            $table->timestamps();

            $table->index(['event_id', 'domain_id']); // Adding indexes for faster querying
        });

        // Create event_asset_needs table with polymorphic relationships
        Schema::create('event_asset_needs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->integer('quantity')->default(1); // Number of units needed
            $table->text('notes')->nullable(); // Additional notes for the asset requirement

            // Polymorphic relationship for assets
            $table->morphs('assetable'); // assetable_id, assetable_type

            $table->timestamps();

            // Adding index for faster queries on event_id and polymorphic relationship
            $table->index(['event_id', 'assetable_type', 'assetable_id']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop tables in reverse order of creation to maintain foreign key integrity
        Schema::dropIfExists('event_asset_needs');
        Schema::dropIfExists('event_domain');
        Schema::dropIfExists('event_category');
        Schema::dropIfExists('event_fees');
        Schema::dropIfExists('events');
        Schema::dropIfExists('event_domains');
        Schema::dropIfExists('event_categories');
    }
};
