<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePost extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required'],
            'text' => ['required'],
            'slug'  => ['required', 'min:2', 'alpha_dash'],
            'image' => ['mimes:jpeg,jpg,png,JPG,PNG', 'image_size:>=900,>=300', 'max:10000']
        ];
    }
}
