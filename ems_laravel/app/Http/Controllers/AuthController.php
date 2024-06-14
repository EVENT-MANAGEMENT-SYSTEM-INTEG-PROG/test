<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\LoginRequest;


class AuthController extends Authenticatable
{

    public function __construct() {
        $this->model = new User();
    }


    /**
     *  /api/user/login
     * Store a newly created resource in storage.
     */
    public function loginAccount(LoginRequest $request)
    {
        try {

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


    // /api/user/signup
    // Create Account function
    public function createAccount(UserStoreRequest $request)
    {
        try {
            $this->model->create($request->all());
            return response(['message' => "Successfully created"], 201);
        } catch (\Throwable $e) {
            return response(['message' => $e->getMessage()], 400);
        }

    }


    public function logoutAccount(Request $request) {
        try {
            $request->user()->currentAccessToken()->delete();

            return response(['message' => 'Successfully logout'], 200);
        } catch (\Throwable $th) {
            return response(['message' => $th->getMessage()], 400);
        }
    }

    /**
     * /api/user/me
     */
    public function show(Request $request)
    {
        return response()->json($request->user(), 200);
    }


}
