<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'title' => ['required', 'min:5'],
            'desc' => ['required', 'min:50'],
            'price' => ['required', 'min:2', 'integer'],
            'categories' => ['required'],
            'images' => ['required'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];
    }
}
