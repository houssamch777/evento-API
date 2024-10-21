<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssetResource extends JsonResource
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
            'user_id' => $this->user_id,
            'name' => $this->name,
            'description' => $this->description,
            'daily_rental_price' => $this->daily_rental_price,
            'is_available' => $this->is_available,
            'location' => $this->location,
            'image_url' => $this->image_url,
            'assetable' => new AssetableResource($this->assetable),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
