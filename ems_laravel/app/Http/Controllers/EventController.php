<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Models\Event;
use App\Models\User;
use App\Notifications\eventNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class EventController extends Controller
{
    public function index()
    {
        return response(Event::all(), 200);
    }

    public function store(StoreEventRequest $request)
    {
        $users = User::all();
        try {
            $createdEvent = Event::create($request->all());

            // Manually create notifications for each user
            foreach ($users as $user) {
                \DB::table('notifications')->insert([
                    'user_id' =>  $request->user_id,
                    'schedule_id' => $createdEvent->id, // assuming schedule_id is the event ID
                    'notification_message' => 'You are invited to ' . $request->event_name,
                    'notification_status' => 'unread',
                    'notification_type' => 'event',
                    'notification_date_time' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return response($createdEvent, 200);
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
            return response(['message'=>$th->getMessage()], 400);
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
            return response(['message'=>$th->getMessage()], 400);
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
            return response(['message'=>$th->getMessage()], 400);
        }
    }
}
