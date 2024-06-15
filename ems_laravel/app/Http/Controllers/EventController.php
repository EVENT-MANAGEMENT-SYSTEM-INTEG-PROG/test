<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EventNotification;

class EventController extends Controller
{
    public function index()
    {
        return response(Event::all(), 200);
    }

    public function store(StoreEventRequest $request)
    {
        try {
            $createdEvent = Event::create($request->all());
            return response($createdEvent, 201);
        } catch (\Throwable $th) {
            return response(["message" => $th->getMessage()], 400);
        }
    }

    public function show(Event $event, string $id)
    {
        try {
            $eventDetails = $event->find($id);

            if ($eventDetails) {
                return response($eventDetails, 200);
            } else {
                return response(['message' => 'Event not found'], 404);
            }
        } catch (\Throwable $th) {
            return response(['message' => $th->getMessage()], 400);
        }
    }

    public function update(StoreEventRequest $request, Event $event, string $id)
    {
        try {
            $eventDetails = $event->find($id);

            if (!$eventDetails) {
                return response(['message' => 'Event not found']);
            } else {
                $eventDetails->update($request->validated());
            }

            return response(['message' => $eventDetails], 200);
        } catch (\Throwable $th) {
            return response(['message' => $th->getMessage()], 400);
        }
    }

    public function destroy(Event $event, string $id)
    {
        try {
            $eventDetails = $event->findOrFail($id);

            if (!$eventDetails) {
                return response(['message' => 'Event not found']);
            } else {
                $eventDetails->delete();
            }

            return response(['message' => 'Event has been deleted']);
        } catch (\Throwable $th) {
            return response(['message' => $th->getMessage()], 400);
        }
    }

    public function notifyParticipants(string $id)
    {
        try {
            $event = Event::findOrFail($id);

            foreach ($event->participants as $participant) {
                Mail::to($participant->email)->send(new EventNotification($event));
            }

            return response(['message' => 'Notifications sent'], 200);
        } catch (\Throwable $th) {
            return response(['message' => $th->getMessage()], 400);
        }
    }

    public function checkConflict(Request $request)
    {
        $request->validate([
            'event_date' => 'required|date',
            'event_time' => 'required|date_format:H:i',
        ]);

        $conflicts = Event::where('event_date', $request->event_date)
                          ->where('event_time', $request->event_time)
                          ->exists();

        return response()->json(['conflict' => $conflicts], 200);
    }
}
