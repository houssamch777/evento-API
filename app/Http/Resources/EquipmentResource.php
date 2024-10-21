<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EquipmentResource extends JsonResource
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
            'category' => [
                'id' => $this->category->id, // Accessing related Category model
                'name' => $this->category->name, // Accessing category name
            ],
            'available_quantity' => $this->available_quantity,
            'condition' => $this->condition,
        ];
    }
}
