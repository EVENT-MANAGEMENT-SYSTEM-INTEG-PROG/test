<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EventNotification;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        return response(Event::all(), 200);
    }

    public function myEvent(Request $request) 
    {
        //return response(Event::where('user_id', $request->user()->user_id));
        return response(Event::where('user_id', $request->user()->user_id)->get(), 200);
    }

    public function assignEvent(Request $request)
    {
        return response(Event::where('organizer', $request->user()->user_id)->get(), 200);
    }

    public function store(StoreEventRequest $request)
    {
        try {
            $validatedData = $request->validated();

            // Decode base64 image data and save to storage
            if ($request->has('event_image')) {
                $imageData = $request->input('event_image');
                $imageData = str_replace('data:image/jpeg;base64,', '', $imageData);
                $imageData = str_replace(' ', '+', $imageData);
                $imageName = time() . '_' . uniqid() . '.jpg'; // Generate unique image name
                $imagePath = 'events/' . $imageName; // Save to events directory

                Storage::disk('public')->put($imagePath, base64_decode($imageData));

                $validatedData['event_image'] = $imagePath; // Save image path to validated data
            }

            $createdEvent = Event::create([...$validatedData, "user_id" => $request->user()->user_id]);
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
            }

            // Delete event image from storage if it exists
            if ($eventDetails->event_image) {
                Storage::disk('public')->delete($eventDetails->event_image);
            }

            $eventDetails->delete();

            return response(['message' => 'Event and associated image have been deleted']);
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
