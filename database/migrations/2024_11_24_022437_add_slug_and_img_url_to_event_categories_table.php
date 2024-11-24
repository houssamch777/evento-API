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
        Schema::table('event_categories', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('name'); // Make 'slug' nullable initially
            $table->string('img_url')->nullable()->default('default-image-url')->after('description');
        });

        // Generate unique slugs for existing rows
        $existingCategories = \DB::table('event_categories')->get();
        foreach ($existingCategories as $category) {
            \DB::table('event_categories')
                ->where('id', $category->id)
                ->update(['slug' => Str::slug($category->name) . '-' . $category->id]); // Ensures unique slug
        }

        // Add unique constraint after setting slugs
        Schema::table('event_categories', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_categories', function (Blueprint $table) {
            //
           
            $table->dropColumn(['slug', 'img_url']); // Drops the columns if rolled back
        });
    }
};
