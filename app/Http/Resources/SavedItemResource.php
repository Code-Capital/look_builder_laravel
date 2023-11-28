<?php

namespace App\Http\Resources;

use App\Models\LookBuilderProduct;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SavedItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->user->name,
            'product' => new LookBuilderProductResource($this->lookBuilderProduct),
        ];
    }
}
