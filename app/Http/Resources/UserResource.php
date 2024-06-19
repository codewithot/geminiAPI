<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> (string)$this->id,
            'name'=>(string)$this->name,
            'email'=>(string)$this->email,
            'level'=>(string)$this->level,
            'role'=>(string)$this->role,
            'phoneNumber'=>(string)$this->phone_number,
            'isActive'=>(string)$this->is_active? true : false,
        ];
    }
}
