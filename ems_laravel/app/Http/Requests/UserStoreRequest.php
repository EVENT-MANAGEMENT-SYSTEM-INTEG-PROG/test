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
            'role_id' => 'required|int',
            'first_name'=> 'required|string',
            'last_name'=> 'required|string',
            'gender'=> 'required|string',
            'date_of_birth'=> 'required|string',
            'email' => 'required|email|unique:users,email',
            'user_name'=> 'required|string|unique:users,user_name',
            'password' => 'required|string|min:6',
            'mobile_number'=> 'required|string',
            'country'=> 'required|string',
        ];
    }
}
