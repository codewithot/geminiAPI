<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
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
            'title'=>(string)$this->title,
            'description'=>(string)$this->description,
            'department'=>(string)$this->department,
            'employmentType'=>(string)$this->employment_type,
            'location'=>(string)$this->location,
            'isActive'=>(string)$this->is_active? true : false,
            'salary'=>(string)$this->salary,
            // 'applicants'=>(string)$this->applicant?->first_name,
        ];
    }
}
