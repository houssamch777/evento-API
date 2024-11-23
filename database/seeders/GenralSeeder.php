<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $this->call(LocationsTableSeeder::class);
        $this->call(AssetCategoriesSeeder::class);
        $this->call(EventCategoriesSeeder::class);
        $this->call(EventDomainsSeeder::class);
        $this->call(FacilitySeeder::class);
        $this->call(TagSeeder::class);
        $this->call(SkillNamesSeeder::class);// Call PostSeeder

    }
}
