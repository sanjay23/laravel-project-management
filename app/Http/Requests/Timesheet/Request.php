<?php

namespace App\Http\Requests\Timesheet;

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
        if ($this->isMethod('POST')) {
            return $this->storeValidate();
        } elseif ($this->isMethod('PUT')) {
            return $this->updateValidate();
        }
        
    }

    public function storeValidate(): array
    {
        return [
            'project_id' => 'required',
            'user_id' => 'required',
            'approved_hours' => 'nullable',
            'log_date' => 'required',
            'logged_hours' => 'required',
            'billable_hours' => 'nullable',
            'description' => 'nullable',
        ];
    }

    public function updateValidate(): array
    {
        return [
            'approved_hours' => 'nullable',
        ];
    }
}