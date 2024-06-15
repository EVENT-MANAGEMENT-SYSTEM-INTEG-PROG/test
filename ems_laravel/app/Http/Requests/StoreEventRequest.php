<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
            'event_name' => 'required|string',
            'event_description' => 'required|string',
            'event_date' => 'required|date',
            'event_time' => ['required', 'regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/'],
            'event_location' => 'required|string',
            'event_status' => 'required|string',
            'organizer' => 'required|string',
            'participants' => 'required|array',
            'participants.*' => 'email',
        ];
    }
}
