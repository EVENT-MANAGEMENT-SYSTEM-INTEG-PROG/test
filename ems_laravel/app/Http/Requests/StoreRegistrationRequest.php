<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegistrationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,user_id',
            'event_id' => 'required|exists:events,event_id',
            'register_status' => 'required|string',
            'register_code' => 'required|int|max:99999',
            'register_date' => 'required|date',
            'register_time' => ['required', 'regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/'],
        ];
    }
}
