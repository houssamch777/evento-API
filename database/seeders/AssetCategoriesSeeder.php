<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EquipmentCategory;
use App\Models\RoomCategory;
use App\Models\FurnitureCategory;
use App\Models\TransportationCategory;

class AssetCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Equipment Categories
        EquipmentCategory::create([
            'name' => 'Cameras',
            'description' => 'High-quality cameras for photography, filming, and live-streaming.'
        ]);
        EquipmentCategory::create([
            'name' => 'Microphones',
            'description' => 'Microphones for sound recording, events, and broadcasting.'
        ]);
        EquipmentCategory::create([
            'name' => 'Lighting',
            'description' => 'Lighting systems for events, conferences, concerts, and photography.'
        ]);
        EquipmentCategory::create([
            'name' => 'Audio Equipment',
            'description' => 'Audio equipment including mixers, speakers, and sound systems.'
        ]);
        EquipmentCategory::create([
            'name' => 'Projectors & Screens',
            'description' => 'Projectors, screens, and visual equipment for presentations and events.'
        ]);
        EquipmentCategory::create([
            'name' => 'Staging & Rigging',
            'description' => 'Stage setups, trusses, and rigging equipment for performances and events.'
        ]);
        EquipmentCategory::create([
            'name' => 'Drones',
            'description' => 'Drones for aerial photography and videography for events.'
        ]);
        EquipmentCategory::create([
            'name' => 'Generators',
            'description' => 'Portable power generators for events requiring additional power sources.'
        ]);

        // Room Categories
        RoomCategory::create([
            'name' => 'Conference Rooms',
            'description' => 'Rooms designed for corporate meetings, presentations, and discussions.'
        ]);
        RoomCategory::create([
            'name' => 'Workshops',
            'description' => 'Spaces designed for hands-on workshops, trainings, and group activities.'
        ]);
        RoomCategory::create([
            'name' => 'Auditoriums',
            'description' => 'Large rooms designed for seminars, performances, and conferences.'
        ]);
        RoomCategory::create([
            'name' => 'Exhibition Halls',
            'description' => 'Large, open spaces for exhibitions, expos, and fairs.'
        ]);
        RoomCategory::create([
            'name' => 'Ballrooms',
            'description' => 'Elegant rooms for banquets, weddings, and large-scale events.'
        ]);
        RoomCategory::create([
            'name' => 'Outdoor Venues',
            'description' => 'Open-air venues for concerts, festivals, and large gatherings.'
        ]);
        RoomCategory::create([
            'name' => 'Meeting Rooms',
            'description' => 'Smaller rooms suitable for meetings, interviews, and brainstorming sessions.'
        ]);

        // Furniture Categories
        FurnitureCategory::create([
            'name' => 'Chairs',
            'description' => 'Seating options for guests, ranging from standard chairs to luxury seating.'
        ]);
        FurnitureCategory::create([
            'name' => 'Tables',
            'description' => 'Tables of various sizes for events, meetings, and dining.'
        ]);
        FurnitureCategory::create([
            'name' => 'Stands & Displays',
            'description' => 'Display stands, booths, and racks for exhibitions and trade shows.'
        ]);
        FurnitureCategory::create([
            'name' => 'Lounge Furniture',
            'description' => 'Comfortable furniture for VIP lounges and relaxation areas during events.'
        ]);
        FurnitureCategory::create([
            'name' => 'Podiums & Stages',
            'description' => 'Raised platforms for speakers and performances.'
        ]);
        FurnitureCategory::create([
            'name' => 'Catering Furniture',
            'description' => 'Furniture used for catering setups, including buffet tables and bars.'
        ]);
        FurnitureCategory::create([
            'name' => 'Portable Seating',
            'description' => 'Lightweight, easy-to-transport chairs and seating for casual events.'
        ]);

        // Transportation Categories
        TransportationCategory::create([
            'name' => 'Vans',
            'description' => 'Small transport vehicles for small groups, usually up to 15 passengers.'
        ]);
        TransportationCategory::create([
            'name' => 'Buses',
            'description' => 'Large transport vehicles for group transport, capable of carrying more than 30 passengers.'
        ]);
        TransportationCategory::create([
            'name' => 'Shuttles',
            'description' => 'Vehicles for shuttling event guests between locations, typically at large venues.'
        ]);
        TransportationCategory::create([
            'name' => 'Luxury Cars',
            'description' => 'High-end cars for VIP transportation and executive needs.'
        ]);
        TransportationCategory::create([
            'name' => 'Trolleys & Carts',
            'description' => 'Transport carts for moving equipment and materials within event venues.'
        ]);
        TransportationCategory::create([
            'name' => 'Boats',
            'description' => 'Boats for events held near water or for luxury transport to remote venues.'
        ]);
        TransportationCategory::create([
            'name' => 'Helicopters',
            'description' => 'Helicopters for transporting VIPs to exclusive venues or for aerial photography.'
        ]);
    }
}
