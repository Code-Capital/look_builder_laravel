<?php

namespace App\Http\Controllers\Web\Custom;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomSuitResource;
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
}
