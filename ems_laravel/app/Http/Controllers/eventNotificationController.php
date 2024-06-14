<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class eventNotificationController extends Controller
{
    public function index(){
        $user = User::find(1);
    }
}
