<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'first_name'=> 'required|string',
            'last_name'=> 'required|string',
            'gender'=> 'required|string',
            'date_of_birth'=> 'required|string',
            'email'=> 'required|email',
            'user_name'=> 'required|string',
            'mobile_number'=> 'required|string',
            'street_address'=> 'required|string',
            'city'=> 'required|string',
            'post_code'=> 'required|string',
            'country'=> 'required|string',
        ];
    }
}
