<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
                // Sample facilities to be inserted into the facilities table
                $facilities = [
                    ['name' => 'Projector'],
                    ['name' => 'Whiteboard'],
                    ['name' => 'Wi-Fi'],
                    ['name' => 'Audio System'],
                    ['name' => 'Air Conditioning'],
                    ['name' => 'Video Conferencing'],
                    ['name' => 'Heating'],
                    ['name' => 'Lighting System'],
                    ['name' => 'Microwave'],
                    ['name' => 'Refrigerator'],
                ];
        
                // Insert the facilities into the database
                DB::table('facilities')->insert($facilities);
        
                // Optionally, print a message when done
                $this->command->info('Facilities table seeded!');
    }
}
