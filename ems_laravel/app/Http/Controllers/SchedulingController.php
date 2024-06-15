<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSceduleRequest;
use App\Models\Event;
use App\Models\Schedule;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return response(Schedule::all(), 200);
    }

    public function store(StoreScheduleRequest $request)
    {
        try {
            $event_id = $request->input('event_id');
            $schedule_date = $request->input('schedule_date');

            if (Event::where('event_id', $event_id)->exists()) {
                // Check if the Current Event have Already been Scheduled
                return response(['message' => 'Cannot Schedule Event. The Particular Event is Already Scheduled.'], 422);
            }elseif(Schedule::where('schedule_date', $schedule_date)->exists()){
                // Check if the Current Date have Already been Scheduled
                return response(['message' => 'Cannot Schedule Event. The Particular Date is Already Booked.'], 422);
            }

            $createdSched = Schedule::create($request->all());

            return response($createdSched, 200);
        } catch (\Throwable $th) {
            return response(["message"=>$th->getMessage()], 400);
        }
    }

    public function show(Schedule $schedule, string $id)
    {
        try {
            $scheduleDetails = $schedule->find($id);

            if ($scheduleDetails) {
                return response($schdeuletDetails, 200);
            } else {
                return response(['message' => 'Schedule not found'], 404);
            }
        } catch (\Throwable $th) {
            return response(['message'=>$th->getMessage()], 400);
        }
    }

    public function update(StorSscheduleRequest $request, Schedule $schedule, string $id)
    {
        try {
            $scheduleDetails = $schedule->find($id);

            if (!$scheduleDetails) {
                return response(['message' => 'Schedule not found']);
            } else {
                $scheduleDetails->update($request->validated());
            }

            return response(['message' => $scheduleDetails], 200);
        } catch (\Throwable $th) {
            return response(['message'=>$th->getMessage()], 400);
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
