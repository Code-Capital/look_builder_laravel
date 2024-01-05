<?php

namespace App\Http\Controllers\Api\Custom;

use App\Http\Controllers\Controller;
use App\Http\Resources\FabricResource;
use App\Models\Fabric;
use Illuminate\Http\Request;

class SortingController extends Controller
{
    public function newest_first()
    {
        try {
            $fabrics = Fabric::orderBy('created_at', 'desc')->get();
            return response()->json([
                'status' => 200,
                'messsage' => 'Newest Fabrics',
                'data' => FabricResource::collection($fabrics),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'messsage' => 'Internal server error',
            ]);
        }
    }
    public function search($keyword)
    {
        try {
            $fabrics = Fabric::where('name', 'like', '%' . $keyword . '%')->get();
            return response()->json([
                'status' => 200,
                'messsage' => 'Newest Fabrics',
                'data' => FabricResource::collection($fabrics),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'messsage' => 'Internal server error',
            ]);
        }
    }
    public function lowToHigh()
    {
        try {
            $products = Fabric::orderBy('price', 'asc')->get();
            return response()->json([
                'status' => 200,
                'message' => 'Price low to high',
                'data' => FabricResource::collection($products),
            ]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    public function highToLow()
    {
        try {
            $products = Fabric::orderBy('price', 'desc')->get();
            return response()->json([
                'status' => 200,
                'message' => 'Price high to low',
                'data' => FabricResource::collection($products),
            ]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
