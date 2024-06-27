<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function getEventInfo()
    {
        return response()->json([
            'eventName' => 'Mr. & Mrs. Malik Wedding 2026',
            'location' => 'Luxe Hotel Lapasan, Cagayan De Oro',
            'date' => 'August 23, 2026',
            'time' => '9:00 AM - 3:00 PM'
        ]);
    }

    public function getAttendees()
    {
        $attendees = [
            [
                "name" => "John Doe",
                "dateTime" => "2024-06-22 10:00 AM",
                "table" => "Table 1",
                "status" => "Checked In"
            ],
            // other attendees
        ];

        return response()->json($attendees);
    }

    public function addAttendee(Request $request)
    {
        // Validate and add attendee logic
        return response()->json(['message' => 'Attendee added successfully']);
    }

    public function updateAttendee(Request $request, $id)
    {
        // Validate and update attendee logic
        return response()->json(['message' => 'Attendee updated successfully']);
    }

    public function deleteAttendee($id)
    {
        // Delete attendee logic
        return response()->json(['message' => 'Attendee deleted successfully']);
    }
}
