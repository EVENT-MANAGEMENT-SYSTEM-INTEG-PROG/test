<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScheduleRequest;
use App\Models\Event;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        // Fetch schedules with related events
        $schedules = Schedule::with('event')->get();
        return response()->json($schedules);
    }

    public function getSchedule(Request $request)
    {
        // Validate the request
        $request->validate([
            'date' => 'required|date',
        ]);

        // Get the date from the request
        $date = $request->input('date');

        // Query the schedule table for the specified date and eager load the event relationship
        $schedules = Schedule::with(['event:event_id,event_name']) // Adjust 'event_name' to match your actual field name in the events table
                        ->whereDate('schedule_date', $date)
                        ->get();

        // Return the schedule data as JSON
        return response()->json($schedules);
    }


    
    public function store(StoreScheduleRequest $request)
    {
        try {
            $event_id = $request->input('event_id');
            $schedule_date = $request->input('schedule_date');


             // Check if the event exists
             $checkEvent = Event::where('event_id', $event_id)
                                ->doesntExist();
            if ($checkEvent) {
                 return response(['message' => 'Event does not Exist'], 422);
            }

            // Check if the event with given event_id is already scheduled on the provided schedule_date
            $existingSchedule = Schedule::where('event_id', $event_id)
                                    ->where('schedule_date', $schedule_date)
                                    ->exists();

            if ($existingSchedule) {
                return response(['message' => 'Cannot Schedule Event. The Particular Event is Already Scheduled for the given date.'], 422);
            }

            // Check if the schedule_date is already booked for any event
            $dateAlreadyBooked = Schedule::where('schedule_date', $schedule_date)
                                        ->exists();

            if ($dateAlreadyBooked) {
                return response(['message' => 'Cannot Schedule Event. The Particular Date is Already Booked for another event.'], 422);
            }

            // If checks pass, create the schedule
            $createdSchedule = Schedule::create([
                'event_id' => $event_id,
                'schedule_date' => $schedule_date,
                // Add other fields as needed from the request
            ]);

            return response($createdSchedule, 200);
        } catch (\Throwable $th) {
            return response(["message" => $th->getMessage()], 400);
        }
    }


    public function show(Schedule $schedule, string $id)
    {
        try {
            $scheduleDetails = $schedule->find($id);

            if ($scheduleDetails) {
                return response($scheduleDetails, 200);
            } else {
                return response(['message' => 'Schedule not found'], 404);
            }
        } catch (\Throwable $th) {
            return response(['message'=>$th->getMessage()], 400);
        }
    }

    public function update(StoreScheduleRequest $request, Schedule $schedule, string $id)
    {
        try {
            // Find the schedule by $id
            $scheduleDetails = $schedule->find($id);
    
            // Check if schedule exists
            if (!$scheduleDetails) {
                return response(['message' => 'Schedule not found'], 404);
            }
    
            // Validate if event exists (optional)
            $event_id = $request->input('event_id');
            $checkEvent = Event::where('event_id', $event_id)->exists();
            if (!$checkEvent) {
                return response(['message' => 'Event does not exist'], 422);
            }
    
            // Validate if the new schedule date conflicts with existing schedules (optional)
            $newScheduleDate = $request->input('schedule_date');
            $existingSchedule = Schedule::where('event_id', $event_id)
                                        ->where('schedule_date', '!=', $scheduleDetails->schedule_date) // Exclude current schedule date
                                        ->where('schedule_date', $newScheduleDate)
                                        ->exists();
            if ($existingSchedule) {
                return response(['message' => 'Cannot update schedule. The new date is already booked for another event.'], 422);
            }
    
            // Update the schedule
            $scheduleDetails->update([
                'event_id' => $event_id,
                'schedule_date' => $newScheduleDate,
                // Add other fields as needed from the request
            ]);
    
            // Optionally, fetch the updated schedule details and return
            $updatedSchedule = Schedule::find($id);
    
            return response($updatedSchedule, 200);
        } catch (\Throwable $th) {
            return response(['message' => $th->getMessage()], 400);
        }
    }

    public function destroy(Schedule $schedule, string $id)
    {
        try {
            $scheduleDetails = $schedule->findOrFail($id);

            if (!$scheduleDetails) {
                return response(['message' => 'Schedule not found']);
            } else {
                $scheduleDetails->delete();
            }

            return response(['message' => 'Schedule has been deleted']);
        } catch (\Throwable $th) {
            return response(['message'=>$th->getMessage()], 400);
        }
    }
}
