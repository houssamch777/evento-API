<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Equipment Categories Table
        Schema::create('equipment_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Equipment category, e.g., Camera, Lighting');
            $table->text('description')->nullable()->default('')->comment('Description of the equipment category');
            $table->timestamps();
        });

        // Equipment Table
        Schema::create('equipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipment_category_id')->constrained('equipment_categories')->cascadeOnDelete();
            $table->unsignedInteger('available_quantity')->default(1)->comment('Quantity available for rent');
            $table->enum('condition', ['new', 'good', 'fair', 'poor'])->default('new')->comment('Condition of the equipment');
            $table->timestamps();
        });

        // Room Categories Table
        Schema::create('room_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Category of room, e.g., Conference Room, Workshop Space');
            $table->text('description')->nullable()->default('')->comment('Details about the room category');
            $table->timestamps();
        });

        // Rooms Table
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_category_id')->constrained('room_categories')->cascadeOnDelete();
            $table->string('location')->nullable()->comment('Physical location of the room');
            $table->unsignedInteger('capacity')->nullable()->comment('Maximum capacity of the room');
            $table->timestamps();
        });

        // Facilities Table
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Facility name, e.g., WiFi, Projector');
            $table->timestamps();
        });

        // Room-Facility Pivot Table
        Schema::create('room_facilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained('rooms')->cascadeOnDelete();
            $table->foreignId('facility_id')->constrained('facilities')->cascadeOnDelete();
            $table->boolean('is_available')->default(false)->comment('Availability of the facility in the room');
            $table->timestamps(); // Added for tracking changes
        });

        // Furniture Categories Table
        Schema::create('furniture_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Category of furniture, e.g., Chairs, Tables');
            $table->text('description')->nullable()->default('')->comment('Description of the furniture category');
            $table->timestamps();
        });

        // Furniture Table
        Schema::create('furnitures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('furniture_category_id')->constrained('furniture_categories')->cascadeOnDelete();
            $table->unsignedInteger('available_quantity')->default(1)->comment('Quantity available for rent');
            $table->timestamps();
        });

        // Transportation Categories Table
        Schema::create('transportation_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Transportation category, e.g., Van, Bus');
            $table->text('description')->nullable()->default('')->comment('Description of the Transportation category');
            $table->timestamps();
        });

        // Transportation Table
        Schema::create('transportations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transportation_category_id')->constrained('transportation_categories')->cascadeOnDelete();
            $table->unsignedInteger('capacity')->nullable()->comment('Passenger capacity');
            $table->timestamps();
        });

        // Assets Table
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->comment('User who owns the asset');
            $table->string('name')->comment('Asset name');
            $table->text('description')->nullable()->default('')->comment('Details about the asset');
            $table->decimal('daily_rental_price', 8, 2)->default(0.00)->comment('Daily rental price for the asset');
            $table->boolean('is_available')->default(true)->comment('Asset availability status');
            $table->string('location')->nullable()->comment('Physical location of the asset');
            $table->nullableMorphs('assetable'); // Polymorphic relationship for equipment, rooms, etc.
            $table->string('image_url')->nullable()->comment('URL of the asset image');
            $table->timestamps();
        });

        // Equipment-Room Pivot Table
        Schema::create('equipment_room', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipment_id')->constrained('equipments')->cascadeOnDelete();
            $table->foreignId('room_id')->constrained('rooms')->cascadeOnDelete();
            $table->unsignedInteger('quantity')->default(1)->comment('Quantity of equipment in the room');
            $table->timestamps(); // Added for tracking changes
        });
    }

    public function down()
    {
        // Drop Pivot and Child Tables first to avoid foreign key constraint issues
        Schema::dropIfExists('equipment_room');
        Schema::dropIfExists('assets');
        Schema::dropIfExists('transportations');
        Schema::dropIfExists('transportation_categories');
        Schema::dropIfExists('furnitures');
        Schema::dropIfExists('furniture_categories');
        Schema::dropIfExists('room_facilities');
        Schema::dropIfExists('facilities');
        Schema::dropIfExists('rooms');
        Schema::dropIfExists('room_categories');
        Schema::dropIfExists('equipments');
        Schema::dropIfExists('equipment_categories');
    }
};
