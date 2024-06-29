<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Event;

class EventsTableSeeder extends Seeder
{
    public function run()
    {
        // Create events
        $event1 = Event::create([
            'event_name' => 'Tech Summit 2024',
            'event_description' => 'Annual technology conference showcasing latest innovations.',
            'event_date' => '2024-09-15',
            'event_time' => '09:00:00',
            'event_location' => 'Convention Center, City X',
            'event_status' => 'scheduled',
            'created_at' => now(),
            'updated_at' => now(),
            'organizer' => 'John Doe',
            'participants' => '123',
            'user_id' => 1,
        ]);

        // Create more events as needed
    }
}
