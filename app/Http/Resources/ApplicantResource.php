<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicantResource extends JsonResource
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
            'jobTitle'=>(string)$this->job->title,
            'firstName'=>(string)$this->first_name,
            'lastName'=>(string)$this->last_name,
            'email'=>(string)$this->email,
            'salary'=>(string)$this->job->salary,
            'resume'=>(string)$this->resume,
            'coverLetter'=>(string)$this->cover_letter
        ];
    }
}
