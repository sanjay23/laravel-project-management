<?php

namespace App\Http\Requests\User;

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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role_id' => 'required|exists:roles,id',
            'status' => 'in:active,inactive', // Ensure status is either 'active' or 'inactive'
        ];
    }

    public function updateValidate(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->route('user')->id,
            'role_id' => 'required|exists:roles,id',
            'status' => 'in:active,inactive', // Ensure status is either 'active' or 'inactive'
        ];
    }
}