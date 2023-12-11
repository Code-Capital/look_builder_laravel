<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use PDO;

class UserController extends Controller
{
    public function edit()
    {
        try {
            $user = Auth::user();
            return $user;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $user->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'country' => $request->country,
                'state' => $request->state,
                'city' => $request->city,
                'postcode' => $request->postcode,
                'address' => $request->address,
            ]);
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Updated Successfully']);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }
    public function updatePassword(UpdatePasswordRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = Auth::user();

            if (!Hash::check($request->input('current_password'), $user->password)) {
                return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
            }

            $user->update([
                'id' => $user->id,
                'password' => Hash::make($request->input('new_password'))
            ]);
            DB::commit();
            return response()->json(['status' => true, 'messsage' => 'Password changed successfully']);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
            return response()->json(['status' => false, 'messsage' => 'Something went wrong']);
        }
    }
    public function myProfile()
    {
        try {
            $loggedInUser = Auth::user();
            $users = User::where('id', '!=', $loggedInUser->id)->get();
            return view('admin.pages.myAccount', compact('users'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make('password'),
            ]);
            DB::commit();
            return response()->json(['status' => true, 'message' => 'User Created Successfully']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }
    public function delete($user_uuid)
    {
        try {
            DB::beginTransaction();
            $user = User::where('id', $user_uuid)->first();
            $user->delete();
            DB::commit();
            return response()->json(['status' => true, 'message' => 'User deleted successfully']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
        }
    }
}
