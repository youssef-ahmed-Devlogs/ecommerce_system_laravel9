<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'min:3', 'max:50'],
            'last_name' => ['required', 'min:3', 'max:50'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'string', 'max:20', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'user_image' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];
    }
}
