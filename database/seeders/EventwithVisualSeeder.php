<?php

namespace Database\Seeders;


use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventwithVisualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Event::factory()
            ->count(100)
            ->withRelations()
            ->create();
    }
}
