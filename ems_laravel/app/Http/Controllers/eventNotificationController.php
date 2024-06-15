<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class EventNotificationController extends Controller
{
    public function index()
    {
        try {
            // Fetch all notifications ordered by created_at descending
            $notifications = Notification::orderBy('created_at', 'desc')->get();

            return response()->json(['notifications' => $notifications], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
