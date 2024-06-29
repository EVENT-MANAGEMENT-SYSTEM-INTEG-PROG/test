<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
use App\Models\User;
use App\Models\Registration;

class RegistrationsTableSeeder extends Seeder
{
    public function run()
    {
        $user1 = User::where('user_id', '1')->first();
        $event1 = Event::where('event_id', '1')->first();

        if ($user1 && $event1) {
            Registration::create([
                'user_id' => $user1->user_id,
                'event_id' => $event1->event_id,
                'register_status' => 'confirmed',
                'register_code' => 'ABC123',
                'register_date' => now()->toDateString(),
                'register_time' => now()->toTimeString(),
            ]);
        }

        // Create more registrations as needed
    }
}

