<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Authenticatable
{

    public function __construct() {
        $this->model = new User();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function loginAccount(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);


            $credentials = $request->only(['email', 'password']);
    
            
            if (!Auth::attempt($credentials)) {
                return response(['message' => "account doesn't exist"], 404);
            }
    
            $token = $request->user()->createToken('Personal Access Token')->plainTextToken;

    
            return response(['token' => $token], 200);
        } catch (\Throwable $th) {
            return response(['message' => $th->getMessage()], 400);
        }
    }


    public function createAccount(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
                'first_name'=> 'required|string',
                'last_name'=> 'required|string',
                'gender'=> 'required|string',
                'date_of_birth'=> 'required|string',
                'email'=> 'required|email',
                'user_name'=> 'required|string',
                'mobile_number'=> 'required|string',
                'street_address'=> 'required|string',
                'city'=> 'required|string',
                'post_code'=> 'required|string',
                'country'=> 'required|string',
            ]);

            $this->model->create($request->all());
            return response(['message' => "Successfully created"], 201);
        } catch (\Throwable $e) {
            return response(['message' => $e->getMessage()], 400);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return response()->json($request->user(), 200);
    }
}
