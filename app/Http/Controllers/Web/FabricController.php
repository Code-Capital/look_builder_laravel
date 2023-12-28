<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Fabric\AddRequest;
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
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . Str::random(15) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('images/fabrics', $imageName);
            }
            Fabric::create([
                'uuid' => Str::uuid(),
                'name' => $request->title,
                'image' => $imageName,
                'price' => $request->price,
                'composition' => $request->composition,
                'weight' => $request->weight,
                'season' => $request->season,
                'woven_by' => $request->woven_by,
                'fabric_code' => $request->code,
            ]);
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Fabric Created Successfully',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'something went wrong']);
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
                    'status' => true,
                    'message' => 'Fabric Deleted Successfully',
                ]);
            }
            return response()->json(['status' => false, 'message' => 'Fabric Not Found']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'something went wrong']);
        }
    }
    public function edit($uuid)
    {
        try {
            $fabric = Fabric::where('uuid', $uuid)->first();
            if ($fabric != null) {
                return $fabric;
            }
            return response()->json(['status' => false, 'message' => 'Fabric Not Found']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'something went wrong']);
        }
    }
    public function update($uuid, Request $request)
    {
        try {
            DB::beginTransaction();
            $fabric = Fabric::where('uuid', $uuid)->first();
            $imageName = $fabric->image;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . Str::random(15) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('images/fabrics', $imageName);
            }
            if ($fabric != null) {
                $fabric->update([
                    'uuid' => Str::uuid(),
                    'name' => $request->title,
                    'image' => $imageName,
                    'price' => $request->price,
                    'composition' => $request->composition,
                    'weight' => $request->weight,
                    'season' => $request->season,
                    'woven_by' => $request->woven_by,
                    'fabric_code' => $request->fabric_code,
                ]);
                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => 'Fabric Updated successfully',
                ]);
            }
            return response()->json(['status' => false, 'message' => 'Fabric Not Found']);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return response()->json(['status' => false, 'message' => 'something went wrong']);
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
