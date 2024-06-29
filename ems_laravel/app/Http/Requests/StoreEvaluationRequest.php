<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEvaluationRequest extends FormRequest
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
            'event_id'=> 'required|exists:events,event_id',
            'evaluation_rating' => 'required|min:1|max:5',
            'remarks' => 'required|string|max:255',
            'evaluation_status' => 'required|string',
        ];
    }
}
