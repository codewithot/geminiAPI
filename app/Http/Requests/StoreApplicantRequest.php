<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreApplicantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'resume' => 'sometimes|file|mimes:pdf,doc,docx,ppt,pptx,txt|max:4096',
            'cover_letter' => 'sometimes|file|mimes:pdf,doc,docx,ppt,pptx,txt|max:4096',
            'job_id'=> 'required|integer'
        ];

    }
}
