<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Resources\LoginResource;
use App\Http\Resources\RegisterResource;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('users'),
                ],
                'password' => 'required|string|min:8',

            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => '422',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ]);
            }
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'uuid' => Str::uuid(),
            ]);
            $user->assignRole('user');
            $user['jwt'] =  $user->createToken('Api Tokken')->plainTextToken;
            DB::commit();
            return response()->json([
                'status' => 201,
                'message' => 'User registered successfully',
                'data' => new RegisterResource($user),
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ]);
        }
    }
    public function loginUser(Request $request, User $user)
    {
        try {
            if (Auth::attempt($request->all())) {
                $user = Auth::user();
                $user['jwt'] =  auth()->user()->createToken('Api Tokken')->plainTextToken;

                return response()->json([
                    'status' => 200,
                    'message' => 'Logged in Successfully.',
                    'data' => new LoginResource($user),
                ]);
            }
            return response()->json(['status' => 401, 'message' => 'email or password wrong']);
        } catch (\Throwable $e) {
            return response()->json(['status' => 500, 'message' => 'something went wrong']);
        }
    }
    public function logout()
    {
        try {
            if (Auth::user()) {
                $user = Auth::user();
                $user->currentAccessToken()->delete();
                return response()->json(['status' =>  204, 'message' => 'Logged out Successfully.']);
            } else {
                return response()->json(['status' => 401, 'message' => 'Un-authorized']);
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 500, 'message' => 'something went wrong']);
        }
    }
}
