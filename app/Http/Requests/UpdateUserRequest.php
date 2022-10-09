<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email,'.auth()->user()->id,
            'password' => ['required', 'confirmed', Password::min(6)->mixedCase()->numbers()],
            'password_confirmation' => 'requiredWith:password',
        ];
    }
}
