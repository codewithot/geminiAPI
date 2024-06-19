<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
            'authorName'=>(string)$this->user->name,
            'topic'=>(string)$this->topic,
            'body'=>(string)$this->body,
            'category'=>(string)$this->category,
            'image'=>(string)$this->image,
            'isActive'=>(string)$this->is_active? true : false,
        ];
    }
}
