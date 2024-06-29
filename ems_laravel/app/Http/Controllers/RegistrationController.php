<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegistrationRequest;
use App\Models\Registration;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Notifications\EventInvitationNotification;
class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response(Registration::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRegistrationRequest $request)
    {
        try {
            if (Registration::where('event_id',$request->event_id)->get()->count() >= 50) {
                return response(['message' => 'Only 50 people can register for this event.'], 400);
            }
    
            // Create the registration details
            $registrationDetails = Registration::create($request->validated());
    
            // Check if registration status is confirmed
            if ($registrationDetails->register_status === 'confirmed') {
                $user = $registrationDetails->user; //shows details of user & refer that email to send notification
                if ($user) {
                    $user->notify(new EventInvitationNotification($registrationDetails));
                }
            }

            return response($registrationDetails, 200);
        } catch (\Throwable $th) {
            return response(['message' => $th->getMessage()], 400);
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $registrationDetails = Registration::find($id);

            if (!$registrationDetails) {
                return response(['message' => "registration not found"], 404);
            }

            return response($registrationDetails, 200);
        } catch (\Throwable $th) {
            return response(['message'=>$th->getMessage()], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRegistrationRequest $request, string $id)
    {
        try {
            $registrationDetails = Registration::find($id);

            if (!$registrationDetails) {
                return response(['message' => 'Registration not found'], 404);
            }

            $registrationDetails->update($request->validated());

            if ($registrationDetails->register_status === 'confirmed') {
                $user = $registrationDetails->user;
                if ($user) {
                    $user->notify(new EventInvitationNotification($registrationDetails));
                }
                return response(['message' => 'Registration confirmed and notification sent', 'details' => $registrationDetails], 200);
            }

            return response($registrationDetails, 200);
        } catch (\Throwable $th) {
            return response(['message' => $th->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $registrationDetails = Registration::find($id);

            if (!$registrationDetails) {
                return response(['message' => "Registration not found"], 404);
            } else {
                $registrationDetails->delete();
                return response(['message' => 'Event has been deleted']);
            }
        } catch (\Throwable $th) {
            return response(['message' => $th->getMessage()], 400);
        }
    }
    public function userNotify(Request $request){
        try {
            // Example: Retrieve registration (assuming you have a user_id in the Registration model)
            $registration = Registration::find(1);  

            if (!$registration) {
                throw new \Exception('Registration not found');
            }

            // Assuming Registration has a relationship to User model and user() method exists
            $user = $registration->user;

            if (!$user) {
                throw new \Exception('User not found for this registration');
            }

            // Customize your notification messages
            $messages = [
                'Hello' => "Hey, You're registered to this event",
                'code' => 'this is your code 1212',
                'Thank you' => 'Thank you for registering to this event',
            ];

            // Send notification to the user
            $user->notify(new EventInvitationNotification($messages));

            return response()->json(['message' => 'Notification sent'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }
}
