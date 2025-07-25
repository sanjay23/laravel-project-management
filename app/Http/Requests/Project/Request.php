<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;  // Set to false to deny request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'slug' => 'nullable',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
            'type' => 'nullable|in:hourly,fix_cost', // Ensure type is either 'hourly' or 'fix_cost'
            'client_name' => 'nullable|string',
            'budget' => 'nullable|numeric',
            'user_id' => 'nullable|array',
            'user_id.*' => 'exists:users,id',
        ];
    }
}