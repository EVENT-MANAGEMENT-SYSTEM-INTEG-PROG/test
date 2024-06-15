<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Notifications\eventNotification;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    public function index()
    {
        return response(Event::all(), 200);
    }

    public function store(StoreEventRequest $request)
    {
        try {
            $createdEvent = Event::create($request->validated());

            // Dispatch notification for event creation
            $this->dispatchNotification($createdEvent);
            return response($createdEvent, 200);
        } catch (\Throwable $th) {
            return response(["message"=>$th->getMessage()], 400);
        }
    }

    public function update(StoreEventRequest $request, Event $event, string $id)
    {
        try {
            $eventDetails = $event->findOrFail($id);

            $eventDetails->update($request->validated());

            // Dispatch notification for event update
            $this->dispatchNotification($eventDetails);

            return response(['message' => $eventDetails], 200);
        } catch (\Throwable $th) {
            return response(['message'=>$th->getMessage()], 400);
        }
    }


    protected function dispatchNotification(Event $event)
    {
        // Example: Dispatch notification to all users
        $users = User::all();
        
        foreach ($users as $user) {
            $user->notify(new EventNotification($event->event_name));
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