<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UpdateUserRequest;
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

    public function showParticipant() {
        try {
            return User::where('role_id', 2)->get();
        } catch (\Throwable $th) {
            return response(["message" => $th->getMessage()]);
        }
    }

    public function showOrganizer() {
        try {
            return User::where('role_id', 3)->get();
        } catch (\Throwable $th) {
            return response(["message" => $th->getMessage()]);
        }
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

            $user = $request->user();
            $token = $request->user()->createToken('Personal Access Token')->plainTextToken;
            
            return response(['token' => $token, 'role' => $request->user()->role_id], 200);
        } catch (\Throwable $th) {
            return response(['message' => $th->getMessage()], 400);
        }
    }


    /**
     *  PATCH /api/user/me
     * Store a newly created resource in storage.
     */

     public function accountUpdate(UpdateUserRequest $request, User $user)
    {
        try {
            $userDetails = $user->find($request->user()->user_id);

            if (! $userDetails) {
                return response(["message" => "User not found"], 404);
            }

            $userDetails->update($request->validated());

            return response(["message" => "User Successfully Updated"], 200);
        } catch (\Throwable $th) {
            return response(["message" => $th->getMessage()], 400);
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