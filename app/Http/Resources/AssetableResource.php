<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssetableResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        switch (true) {
            case $this->resource instanceof \App\Models\Equipment:
                return (new EquipmentResource($this->resource))->toArray($request);
            case $this->resource instanceof \App\Models\Room:
                return (new RoomResource($this->resource))->toArray($request);
            case $this->resource instanceof \App\Models\Furniture:
                return (new FurnitureResource($this->resource))->toArray($request);
            case $this->resource instanceof \App\Models\Transportation:
                return (new TransportationResource($this->resource))->toArray($request);
            default:
                return [];
        }
    }
}
