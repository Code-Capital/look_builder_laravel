<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Fabric;
use Illuminate\Support\Str;

class FabricController extends Controller
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $fabric = Fabric::create([
                'uuid' => Str::uuid(),
                'name' => $request->name,
            ]);
            DB::commit();
            return response()->json([
                'status' => 201,
                'message' => 'Fabric Created Successfully',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 500, 'message' => 'something went wrong']);
        }
    }
    public function delete($uuid)
    {
        try {
            DB::beginTransaction();
            $fabric = Fabric::where('uuid', $uuid)->first();
            if ($fabric != null) {
                $fabric->delete();
                DB::commit();
                return response()->json([
                    'status' => 200,
                    'message' => 'Fabric Deleted Successfully',
                ]);
            }
            return response()->json(['status' => 204, 'message' => 'Fabric Not Found']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 500, 'message' => 'something went wrong']);
        }
    }
    public function view($uuid)
    {
        try {
            $fabric = Fabric::where('uuid', $uuid)->first();
            if ($fabric != null) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Fabric Details',
                ]);
            }
            return response()->json(['status' => 204, 'message' => 'Fabric Not Found']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 500, 'message' => 'something went wrong']);
        }
    }
    public function update($uuid, Request $request)
    {
        try {
            DB::beginTransaction();
            $fabric = Fabric::where('uuid', $uuid)->first();
            if ($fabric != null) {
                $fabric->update([
                    'id' => $fabric->id,
                    'name' => $request->name,
                ]);
                DB::commit();
                return response()->json([
                    'status' => 200,
                    'message' => 'Fabric Details',
                ]);
            }
            return response()->json(['status' => 204, 'message' => 'Fabric Not Found']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 500, 'message' => 'something went wrong']);
        }
    }
    public function all()
    {
        try {
            $fabrics = Fabric::all();
            return view('admin.pages.fabricList', compact('fabrics'));
        } catch (\Throwable $th) {
            return response()->json(['status' => 500, 'message' => 'something went wrong']);
        }
    }
}
