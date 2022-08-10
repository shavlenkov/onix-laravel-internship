<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdatePostRequest extends FormRequest
{

    public function messages() {
        return [
            'title.required' => "Поле :attribute є обов'язковим.",
            'title.min' => 'Поле :attribute повинно мати мінімум :min символів.',
            'title.max' => 'Поле :attribute повинно мати максимум :max символів.',
            'text.required' => "Поле :attribute є обов'язковим.",
            'text.min' => "Поле :attribute повинно мати мінімум :min символів.",
            'cover.image' => "Поле :attribute повинно бути зображенням.",
            'cover.mimes' => "Поле :attribute повинно бути файлом типу: png, jpeg, gif."
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:5|max:150',
            'text' => 'required|min:10',
            'cover'=> 'image|mimes:png,jpeg,gif',
        ];
    }
}
