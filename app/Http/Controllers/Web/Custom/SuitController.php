<?php

namespace App\Http\Controllers\Web\Custom;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomSuitResource;
use App\Models\CustomProduct;
use App\Models\CustomSuit;
use Illuminate\Http\Request;

class SuitController extends Controller
{
    public function getSuitById($uuid)
    {
        try {
            $suit = CustomSuit::where('uuid', $uuid)->first();
            return response()->json([
                'status' => 200,
                'message' => 'Suit Details',
                'data' => new CustomSuitResource($suit),
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function customSuits()
    {
        try {
            $suits  = CustomSuit::all();
            return  response()->json([
                'status' => 200,
                'message' => 'All Suits',
                'data' => $suits,
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function list()
    {
        try {
            $suits = CustomSuit::all();
            $customProducts = CustomProduct::all();
            return view('admin.pages.custom.allSuits', compact('suits', 'customProducts'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
