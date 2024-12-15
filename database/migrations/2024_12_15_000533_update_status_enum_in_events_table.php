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
        Schema::table('events', function (Blueprint $table) {
            //
            $table->enum('status', ['Scheduled', 'Ready', 'Ongoing', 'Completed', 'Expired', 'Cancelled'])
                  ->default('Scheduled')
                  ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            //
            $table->enum('status', ['Scheduled', 'Completed', 'Cancelled', 'Ongoing'])
              ->default('Scheduled')
              ->change();
        });
    }
};
