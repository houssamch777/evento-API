<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create tags table
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Create posts table
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Post creator
            $table->string('title'); // Post title
            $table->text('content'); // Post content
            $table->string('image_url')->nullable(); // Optional image URL
            $table->foreignId('event_id')->nullable()->constrained('events')->onDelete('cascade'); // Optional event association
            $table->timestamps(); // Created and updated timestamps
        });

        // Create post_likes table
        Schema::create('post_likes', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade'); // Associated post
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // User who liked the post
            $table->timestamps();
            $table->unique(['post_id', 'user_id']); // Ensure a user can like a post only once
        });

        // Create post_comments table
        Schema::create('post_comments', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade'); // Associated post
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // User who commented
            $table->text('content'); // Comment content
            $table->timestamps(); // Timestamps for tracking
        });

        // Create post_tags pivot table
        Schema::create('post_tags', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade'); // Associated post
            $table->foreignId('tag_id')->constrained('tags')->onDelete('cascade'); // Associated tag
            $table->timestamps(); // Timestamps for tracking
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop all the created tables in reverse order of creation
        Schema::dropIfExists('post_tags');
        Schema::dropIfExists('post_comments');
        Schema::dropIfExists('post_likes');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('tags');
    }
};
