<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EnquiryResource extends JsonResource
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
            'message'=>(string)$this->message,
            'phoneNumber'=>(string)$this->phone_number,
        ];
    }
}
